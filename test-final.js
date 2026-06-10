const https = require('https');
const http = require('http');
const BASE = 'desadigital.suruhngoding.com';
let cookieStr = '';

function saveCookies(headers) {
  const sc = headers['set-cookie'] || [];
  sc.forEach(c => {
    const semi = c.indexOf(';');
    const eq = c.indexOf('=');
    const name = c.substring(0, eq);
    const val = c.substring(eq + 1, semi > 0 ? semi : c.length);
    const rx = new RegExp('(^|;\\s*)' + name.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') + '=[^;]*');
    cookieStr.match(rx)
      ? (cookieStr = cookieStr.replace(rx, '$1' + name + '=' + val))
      : (cookieStr += (cookieStr ? '; ' : '') + name + '=' + val);
  });
}

function req(method, path, extraHeaders, body) {
  return new Promise((resolve) => {
    const headers = { 'Cookie': cookieStr, ...(extraHeaders || {}), 'Accept-Encoding': 'identity' };
    const opts = { hostname: BASE, path, method, headers, rejectUnauthorized: false };
    const m = https.request(opts, (res) => {
      let d = '';
      saveCookies(res.headers);
      const hdrs = {};
      Object.keys(res.headers).forEach(k => { hdrs[k] = res.headers[k]; });
      res.on('data', c => d += c);
      res.on('end', () => resolve({ status: res.statusCode, body: d, headers: hdrs }));
    });
    m.on('error', (e) => resolve({ status: 0, body: e.message, headers: {} }));
    if (body) m.write(body);
    m.end();
  });
}

async function main() {
  const p1 = await req('GET', '/login', {});
  const m = p1.body.match(/name="_token".+?value="([^"]+)"/);
  const csrf = m ? m[1] : '';
  const fb = '_token=' + encodeURIComponent(csrf) + '&nik=1234567890123456&password=admin123';
  const lr = await req('POST', '/login', { 'Content-Type': 'application/x-www-form-urlencoded', 'Accept': 'text/html', 'Referer': 'https://' + BASE + '/login' }, fb);
  if (lr.status === 302 && lr.headers.location) {
    await req('GET', lr.headers.location, {});
    // For inertia, also get the page with XHR
  }

  const pages = ['/admin/home', '/admin/surat', '/admin/aparatur', '/admin/news', '/admin/users', '/admin/stores', '/admin/products', '/admin/villagedata', '/admin/refmaster', '/admin/roles', '/admin/permissions', '/admin/templatesurat'];
  let ok = 0, fail = 0, results = [];
  
  for (const p of pages) {
    const r = await req('GET', p, { 'Accept': 'text/html,application/xhtml+xml' });
    if (r.status === 200) ok++; else fail++;
    const title = r.body.match(/<title[^>]*>([^<]+)<\/title>/);
    const line = p + ': ' + r.status + ' ' + (r.status === 200 ? 'PASS' : 'FAIL') + ' ' + (title ? title[1].substring(0, 30) : '');
    console.log(line);
  }
  console.log('OK:' + ok + ' FAIL:' + fail);
}

main().catch(e => console.error(e));
