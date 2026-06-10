const https = require('https');

const BASE = 'desadigital.suruhngoding.com';
let cookieJar = {};

function saveCookies(headers) {
  const sc = headers['set-cookie'];
  if (sc) {
    sc.forEach(c => {
      const eq = c.indexOf('=');
      const semi = c.indexOf(';');
      const name = c.substring(0, eq);
      const val = c.substring(eq + 1, semi > 0 ? semi : c.length);
      cookieJar[name] = val;
    });
  }
}

function cookieString() {
  return Object.entries(cookieJar).map(([k, v]) => `${k}=${v}`).join('; ');
}

function request(method, path, extraHeaders, body) {
  return new Promise((resolve, reject) => {
    const headers = Object.assign({
      'Cookie': cookieString()
    }, extraHeaders || {});
    const opts = {
      hostname: BASE,
      path: path,
      method: method,
      headers: headers,
      rejectUnauthorized: false
    };
    const req = https.request(opts, (res) => {
      let data = '';
      saveCookies(res.headers);
      res.on('data', (c) => data += c);
      res.on('end', () => resolve({ status: res.statusCode, body: data, headers: res.headers }));
    });
    req.on('error', reject);
    if (body) req.write(body);
    req.end();
  });
}

async function main() {
  // Step 1: Get login page
  console.log('=== Login ===');
  const page1 = await request('GET', '/login', {});
  const tokenMatch = page1.body.match(/name="_token".+?value="([^"]+)"/);
  const csrf = tokenMatch ? tokenMatch[1] : null;

  // Step 2: Login
  const formBody = new URLSearchParams();
  formBody.append('_token', csrf);
  formBody.append('nik', '1234567890123456');
  formBody.append('password', 'admin123');

  const loginRes = await request('POST', '/login', {
    'Content-Type': 'application/x-www-form-urlencoded',
    'Accept': 'text/html,application/xhtml+xml',
    'Referer': 'https://' + BASE + '/login'
  }, formBody.toString());
  console.log('Login status:', loginRes.status);
  console.log('Cookies:', Object.keys(cookieJar));

  // Step 3: Follow redirect
  let redirectPath = loginRes.headers.location;
  if (redirectPath) {
    console.log('Follow redirect:', redirectPath);
    const dashRes = await request('GET', redirectPath, {});
    console.log('Dashboard status:', dashRes.status, '(' + dashRes.body.length + ' bytes)');
  }

  // Step 4: Try all admin pages
  console.log('\n=== Admin Pages ===');
  const pages = [
    '/admin/home',
    '/admin/surat',
    '/admin/aparatur',
    '/admin/news',
    '/admin/users',
    '/admin/stores',
    '/admin/products',
    '/admin/villagedata',
    '/admin/refmaster',
    '/admin/roles',
    '/admin/permissions',
    '/admin/templatesurat'
  ];

  for (const p of pages) {
    const r = await request('GET', p, {});
    const ok = r.status === 200;
    const title = ok ? (r.body.match(/<title[^>]*>([^<]+)<\/title>/) || ['', '?'])[1] : 'ERROR';
    console.log(`${p}: ${r.status} ${ok ? '✅' : '❌'} ${title.substring(0, 60)}`);
    if (!ok && r.body.length < 500) {
      console.log('  Body hint:', r.body.substring(0, 200).replace(/\s+/g, ' ').trim());
    }
  }
}

main().catch(console.error);
