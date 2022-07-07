import requests, sys, os, json

os.system('pip install requests')
method = sys.argv[1]

def asiacell(method, data, headers):
    r = requests.post(f"https://www.asiacell.com/api/v1/{method}?lang=ar",headers=headers,json=data)

    return json.dumps(r.json())

def asiacell2(method, headers):
    r = requests.get(f"https://www.asiacell.com/api/v1/{method}?lang=ar",headers=headers)

    return json.dumps(r.json())

if method == 'captcha':
    print(asiacell(method, {}, {'DeviceID': '6cf77389aa2b259c2951a12b3bad0175'}))
    os.remove("a.json") 
if method == 'loginV2':
    print(asiacell(method, {"username":sys.argv[3],"captchaCode":sys.argv[2]}, {'DeviceID': '6cf77389aa2b259c2951a12b3bad0175'}))
    os.remove("a.json")
if method == 'smsvalidation':
    print(asiacell(method, {"PID":sys.argv[3],"passcode":sys.argv[2]}, {'DeviceID': '6cf77389aa2b259c2951a12b3bad0175'}))
    os.remove("a.json")
if method == 'profile':
    print(asiacell2(method, {'Authorization': 'Bearer '+sys.argv[2],'DeviceID': '6cf77389aa2b259c2951a12b3bad0175',}))
    os.remove("a.json") 
if method == 'top-up':
    print(asiacell(method, {"iccid":'null',"voucher":sys.argv[2],"msisdn":'null',"rechargeType":1},{'Authorization': 'Bearer '+sys.argv[3],'DeviceID': '6cf77389aa2b259c2951a12b3bad0175',}))
    os.remove("a.json") 
if method == 'credit-transfer/start':
    print(asiacell(method, {"amount":sys.argv[4],"receiverMsisdn":sys.argv[2]},{'Authorization': 'Bearer '+sys.argv[3],'DeviceID': '6cf77389aa2b259c2951a12b3bad0175',}))
    os.remove("a.json") 
if method == 'credit-transfer/do-transfer':
    print(asiacell(method, {"PID":sys.argv[2],"passcode":sys.argv[4]},{'Authorization': 'Bearer '+sys.argv[3],'DeviceID': '6cf77389aa2b259c2951a12b3bad0175',}))
    os.remove("a.json") 
