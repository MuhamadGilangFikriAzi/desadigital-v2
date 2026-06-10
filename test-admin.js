const https = require('https');
const BASE = 'desadigital.suruhngoding.com';
let cookieStr = '';

function saveCookies(headers) {
  const sc = headers['set-cookie'];
  if (sc) {
    sc.forEach(c => { const semi = c.indexOf(';'); const eq = c.indexOf('='); const name = c.substring(0, eq); const val = c.substring(eq+1, semi > 0 ? semi : c.length); if (!cookieStr.includes(name+'=')) cookieStr += (cookieStr ? '; ' : '') + name+'='+val; });
  }
}

function req(method, path, extraHeaders, body) {
  return new Promise((resolve) => {
    const headers = { 'Cookie': cookieStr, ...(extraHeaders||{}) };
    const opts = { hostname: BASE, path, method, headers, rejectUnauthorized: false };
    const r = https.request(opts, (res) => {
      let d = '';
      saveCookies(res.headers);
      res.on('data', c => d += c);
      res.on('end', () => resolve({ status: res.statusCode, body: d, headers: res.headers }));
    });
    r.on('error', () => resolve({ status: 0, body: '', headers: {} }));
    if (body) r.write(body);
    r.end();
  });
}

async function main() {
  // Step 1: Get login page
  const p1 = await req('GET', '/login', {});
  const tokenMatch = (p1.body || '').match(/name="_token".+?value="([^"]+)"/);
  const csrf = tokenMatch ? tokenMatch[1] : '';
  console.log('Step 1 - Got CSRF token:', csrf.substring(0, 16) + '...');

  // Step 2: Login form POST
  const formBody = '_token=' + encodeURIComponent(csrf) + '&nik=1234567890123456&password=admin123';
  const loginRes = await req('POST', '/login', {
    'Content-Type': 'application/x-www-form-urlencoded',
    'Accept': 'text/html,application/xhtml+xml',
    'Referer': 'https://' + BASE + '/login'
  }, formBody);
  console.log('Step 2 - Login result:', loginRes.status);
  console.log('  Set-Cookie count:', (loginRes.headers['set-cookie']||[]).length);

  // Step 3: Follow redirect
  if (loginRes.status === 302 && loginRes.headers.location) {
    const loc = loginRes.headers.location;
    console.log('Step 3 - Following redirect to:', loc.substring(0, 60));
    await req('GET', loc, {});
  }

  console.log('  Cookie length:', cookieStr.length);

  // Step 4: Test pages
  const pages = ['/admin/home','/admin/surat','/admin/aparatur','/admin/news','/admin/users','/admin/stores','/admin/products','/admin/villagedata','/admin/refmaster','/admin/roles','/admin/permissions','/admin/templatesurat'];
  let ok = 0, fail = 0;
  for (const p of pages) {
    const r = await req('GET', p, {});
    if (r.status === 200) ok++; else fail++;
    console.log(`  ${p}: ${r.status}${r.status===200?' PASS':r.status===302?' REDIR':' FAIL'}`);
  }
  console.log(`\nResult: ${ok} PASS, ${fail} FAIL`);
}

main().catch(console.error);
