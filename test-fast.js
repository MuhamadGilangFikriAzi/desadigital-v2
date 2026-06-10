const https=require('https');
const B='desadigital.suruhngoding.com';
let C='';
function sc(h){(h['set-cookie']||[]).forEach(c=>{const e=c.indexOf('='),s=c.indexOf(';'),n=c.substring(0,e),v=c.substring(e+1,s>0?s:c.length);const rx=new RegExp('(^|;\\s*)'+n+'=[^;]*');C.match(rx)?C=C.replace(rx,'$1'+n+'='+v):C+=(C?'; ':'')+n+'='+v})}
function go(m,p,h,b){return new Promise(r=>{const o={hostname:B,path:p,method:m,headers:{'Cookie':C,...(h||{})},rejectUnauthorized:false};const q=https.request(o,res=>{let d='';sc(res.headers);const hdrs={};Object.keys(res.headers).forEach(k=>hdrs[k]=res.headers[k]);res.on('data',c=>d+=c);res.on('end',()=>r({s:res.statusCode,b:d,h:hdrs}))});q.on('error',e=>r({s:0,b:e.message}));if(b)q.write(b);q.end()})}
(async()=>{
  const p1=await go('GET','/login',{});
  const csrf=(p1.b.match(/name="_token".+?value="([^"]+)"/)||[])[1]||'';
  const fb='_token='+encodeURIComponent(csrf)+'&nik=1234567890123456&password=admin123';
  const lr=await go('POST','/login',{'Content-Type':'application/x-www-form-urlencoded','Accept':'text/html','Referer':'https://'+B+'/login'},fb);
  if(lr.s===302&&lr.h.location)await go('GET',lr.h.location,{});
  const ps=['/admin/home','/admin/surat','/admin/aparatur','/admin/news','/admin/users','/admin/stores','/admin/products','/admin/villagedata','/admin/refmaster','/admin/roles','/admin/permissions','/admin/templatesurat'];
  let r='';
  for(const p of ps){const x=await go('GET',p,{});const t=x.b.match(/<title[^>]*>([^<]+)<\/title>/);r+=p+': '+x.s+(x.s===200?' PASS':' FAIL')+' '+(t?t[1].substring(0,30):'')+'\n'}
  require('fs').writeFileSync('C:\\Users\\mgfa9\\Project\\desadigital-v2\\test-result.txt',r);
  console.log('Done - '+r.split('\n').filter(l=>l.includes('PASS')).length+' PASS, '+r.split('\n').filter(l=>l.includes('FAIL')).length+' FAIL');
})();
