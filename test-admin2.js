const https = require('https');
const BASE = 'desadigital.suruhngoding.com';
let cookieStr = '';

function saveCookies(headers) {
  const sc = headers['set-cookie'] || [];
  sc.forEach(c => {
    const semi = c.indexOf(';');
    const eq = c.indexOf('=');
    const name = c.substring(0, eq);
    const val = c.substring(eq + 1, semi > 0 ? semi : c.length);
    // Replace or append
    const regex = new RegExp('(^|;\\s*)' + name + '=[^;]*');
    if (cookieStr.match(regex)) {
      cookieStr = cookieStr.replace(regex, '$1' + name + '=' + val);
    } else {
      cookieStr += (cookieStr ? '; ' : '') + name + '=' + val;
    }
  });
}

function req(method, path, extraHeaders, body) {
  return new Promise((resolve) => {
    const headers = { 'Cookie': cookieStr, ...(extraHeaders || {}), 'Accept-Encoding': 'identity' };
    const opts = { hostname: BASE, path, method, headers, rejectUnauthorized: false };
    const r = https.request(opts, (res) => {
      let d = '';
      let hdrs = {};
      Object.keys(res.headers).forEach(k => hdrs[k] = res.headers[k]);
      saveCookies(res.headers);
      res.on('data', c => d += c);
      res.on('end', () => resolve({ status: res.statusCode, body: d, headers: hdrs }));
    });
    r.on('error', (e) => resolve({ status: 0, body: e.message }));
    if (body) r.write(body);
    r.end();
  });
}

async function main() {
  // Step 1: GET login page
  const p1 = await req('GET', '/login', {});
  const tokenMatch = (p1.body || '').match(/name="_token".+?value="([^"]+)"/);
  const csrf = tokenMatch ? tokenMatch[1] : 'NO_TOKEN';
  console.log('CSRF:', csrf.substring(0,12));

  // Step 2: POST login
  const fb = '_token=' + encodeURIComponent(csrf) + '&nik=1234567890123456&password=admin123';
  const lr = await req('POST', '/login', {
    'Content-Type': 'application/x-www-form-urlencoded',
    'Accept': 'text/html,application/xhtml+xml',
    'Referer': 'https://' + BASE + '/login'
  }, fb);
  console.log('Login:', lr.status, '->', lr.headers.location || 'none');

  // Step 3: Follow redirect to dashboard
  if (lr.headers.location) {
    await req('GET', lr.headers.location, {});
  }

  // Step 4: Hit /admin/home with full cookie
  const r = await req('GET', '/admin/home', {});
  const title = (r.body || '').match(/<title[^>]*>([^<]+)<\/title>/);
  console.log('/admin/home:', r.status, title ? title[1].substring(0,50) : (r.body ? r.body.substring(0,120).replace(/\s+/g,' ').trim() : 'empty'));

  // Check if redirected
  if (r.status === 302) {
    console.log('  Redirected to:', lr.headers.location);
    console.log('  Cookie:', cookieStr.substring(0,100) + '...');
  }

  // If home works, test all others
  if (r.status !== 200) {
    console.log('\nSession not working. Exiting.');
    return;
  }

  const pages = ['/admin/surat','/admin/aparatur','/admin/news','/admin/users','/admin/stores','/admin/products','/admin/villagedata','/admin/refmaster','/admin/roles','/admin/permissions','/admin/templatesurat'];
  let ok=0, fail=0;
  for (const p of pages) {
    const rr = await req('GET', p, {});
    const t = (rr.body || '').match(/<title[^>]*>([^<]+)<\/title>/);
    console.log(`${p}: ${rr.status} ${rr.status===200?'PASS':'FAIL'} ${t?t[1].substring(0,40):(rr.body||'').substring(0,80).replace(/\s+/g,' ').trim()}`);
    if (rr.status===200) ok++; else fail++;
  }
  console.log(`\nResult: ${ok} PASS, ${fail} FAIL`);
}
main();
