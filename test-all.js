const https = require('https');

let cookieStr = '';
function saveCookies(res) {
  const sc = res.headers['set-cookie'] || [];
  sc.forEach(c => {
    const eq = c.indexOf('=');
    const valEnd = c.indexOf(';');
    const name = c.substring(0, eq);
    const val = c.substring(eq + 1, valEnd > 0 ? valEnd : c.length);
    const rx = new RegExp('(^|;\\s*)' + name.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') + '=[^;]*');
    cookieStr.match(rx)
      ? (cookieStr = cookieStr.replace(rx, '$1' + name + '=' + val))
      : (cookieStr += (cookieStr ? '; ' : '') + name + '=' + val);
  });
}

function request(method, path, body, headers) {
  return new Promise((resolve) => {
    const opts = {
      hostname: 'desadigital.suruhngoding.com',
      path: path, method: method,
      headers: { 'Cookie': cookieStr, ...(headers || {}), 'Accept-Encoding': 'identity', 'User-Agent': 'Mozilla/5.0' },
      rejectUnauthorized: false
    };
    const req = https.request(opts, (res) => {
      let data = '';
      saveCookies(res);
      res.on('data', chunk => data += chunk);
      res.on('end', () => resolve({ status: res.statusCode, headers: res.headers, body: data }));
    });
    req.on('error', e => resolve({ status: 0, body: '', headers: {} }));
    if (body) req.write(body);
    req.end();
  });
}

async function main() {
  // Step 1: GET login page
  const r1 = await request('GET', '/login');
  const m = r1.body.match(/name="_token".+?value="([^"]+)"/);
  const token = m ? m[1] : '';
  console.log('TOKEN:', token ? token.substr(0, 16) : 'NOT FOUND');
  
  if (!token) { console.log('FAILED: token not found'); return; }

  // Step 2: POST login
  const payload = '_token=' + encodeURIComponent(token) + '&nik=1234567890123456&password=admin123';
  const r2 = await request('POST', '/login', payload, {
    'Content-Type': 'application/x-www-form-urlencoded',
    'Accept': 'text/html',
    'Referer': 'https://desadigital.suruhngoding.com/login'
  });
  console.log('LOGIN:', r2.status, r2.headers.location || 'no-redirect');

  // Step 3: Follow redirect if any
  if (r2.status === 302 && r2.headers.location) {
    const r3 = await request('GET', r2.headers.location);
    console.log('AFTER-LOGIN:', r3.status, (r3.body.match(/<title[^>]*>([^<]+)<\/title>/) || [])[1] || 'no-title');
  }

  // Step 4: Test admin pages
  const pages = ['/admin/home', '/admin/surat', '/admin/aparatur', '/admin/news', '/admin/users', '/admin/stores', '/admin/products', '/admin/villagedata', '/admin/refmaster', '/admin/roles', '/admin/permissions', '/admin/templatesurat'];
  let ok = 0, fail = 0;
  
  for (const p of pages) {
    const r = await request('GET', p, null, { 'Accept': 'text/html' });
    const status = r.status;
    const title = (r.body.match(/<title[^>]*>([^<]+)<\/title>/) || [])[1] || '';
    const pass = status === 200;
    if (pass) ok++; else fail++;
    console.log(p + ': ' + status + ' ' + (pass ? 'PASS' : 'FAIL') + ' ' + (title.substr(0, 40)));
  }
  
  console.log('\n=== SUMMARY: ' + ok + ' OK, ' + fail + ' FAIL ===');
  
  require('fs').writeFileSync('C:\\Users\\mgfa9\\Project\\desadigital-v2\\admin-result.txt',
    'Total: ' + ok + ' PASS, ' + fail + ' FAIL\n');
}

main().catch(e => console.error(e));
