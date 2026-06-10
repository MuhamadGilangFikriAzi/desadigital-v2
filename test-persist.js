const https=require('https');
const fs=require('fs');
const B='desadigital.suruhngoding.com';
const CF='C:\\Users\\mgfa9\\Project\\desadigital-v2\\session-cookie.txt';
let C='';
try{C=fs.readFileSync(CF,'utf8').trim()}catch(e){}
function sc(h){(h['set-cookie']||[]).forEach(c=>{const e=c.indexOf('='),s=c.indexOf(';'),n=c.substring(0,e),v=c.substring(e+1,s>0?s:c.length);const rx=new RegExp('(^|;\\s*)'+n.replace(/[.*+?^${}()|[\]\\]/g,'\\$&')+'=[^;]*');C.match(rx)?C=C.replace(rx,'$1'+n+'='+v):C+=(C?'; ':'')+n+'='+v});fs.writeFileSync(CF,C)}
function go(m,p,h,b){return new Promise(r=>{const q=https.request({hostname:B,path:p,method:m,headers:{'Cookie':C,...(h||{})},rejectUnauthorized:false},res=>{let d='';sc(res.headers);const h={};Object.keys(res.headers).forEach(k=>h[k]=res.headers[k]);res.on('data',c=>d+=c);res.on('end',()=>r({s:res.statusCode,b:d,hd:h}))});q.on('error',e=>r({s:0,b:e.message}));if(b)q.write(b);q.end()})}
async function main(){
  const cmd=process.argv[2];
  if(cmd==='login'){
    const p1=await go('GET','/login',{});
    const csrf=(p1.b.match(/name="_token".+?value="([^"]+)"/)||[])[1]||'';
    await go('POST','/login',{'Content-Type':'application/x-www-form-urlencoded','Accept':'text/html'},'_token='+encodeURIComponent(csrf)+'&nik=1234567890123456&password=admin123');
    const r=await go('GET','/admin/home',{});
    console.log((r.b.match(/<title[^>]*>([^<]+)<\/title>/)||['',''])[1]);
  }else{
    const r=await go('GET',cmd||'/admin/home',{});
    const t=r.b.match(/<title[^>]*>([^<]+)<\/title>/);
    console.log(r.s+' '+(t?t[1].substring(0,30):''));
  }
}
main();
