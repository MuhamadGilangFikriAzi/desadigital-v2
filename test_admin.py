import subprocess, re
result = subprocess.run(["curl", "-s", "-c", "/tmp/cj15.txt", "-b", "/tmp/cj15.txt", "http://localhost/login"], capture_output=True, text=True)
m = re.search(r'name="_token".*?value="([^"]+)', result.stdout)
csrf = m.group(1) if m else ""
subprocess.run(["curl", "-s", "-c", "/tmp/cj15.txt", "-b", "/tmp/cj15.txt", "-L", "-X", "POST", "http://localhost/login", "-d", f"_token={csrf}&nik=1234567890123456&password=admin123"], capture_output=True)
pages = ["/admin/home","/admin/surat","/admin/aparatur","/admin/news","/admin/users","/admin/stores","/admin/products","/admin/villagedata","/admin/refmaster","/admin/roles","/admin/permissions","/admin/templatesurat"]
ok = 0; fail = 0
for p in pages:
    r = subprocess.run(["curl", "-s", "-o", "/dev/null", "-w", "%{http_code}", "-b", "/tmp/cj15.txt", f"http://localhost{p}"], capture_output=True, text=True)
    c = r.stdout.strip()
    if c == "200": ok += 1
    else: fail += 1
    print(f"{p}: {c} {'PASS' if c=='200' else 'FAIL'}")
print(f"OK:{ok} FAIL:{fail}")
