# LifeVault NFC Prototype

This is a minimal local prototype for testing:

NFC Card -> LifeVault URL -> Emergency Profile

## Run with Laragon

1. Extract/copy this folder into:
   C:\laragon\www\LifeVault-NFC-Prototype

2. Start Apache in Laragon.

3. On your PC open:
   http://localhost/LifeVault-NFC-Prototype/?id=ARYAN001

4. Find your PC's local IPv4 address:
   Open Command Prompt and run:
   ipconfig

   Look for the IPv4 Address under the Wi-Fi adapter.
   Example:
   192.168.1.105

5. Your phone and PC must be connected to the same Wi-Fi.

6. On the phone test:
   http://YOUR-PC-IP/LifeVault-NFC-Prototype/?id=ARYAN001

   Example:
   http://192.168.1.105/LifeVault-NFC-Prototype/?id=ARYAN001

7. If the page opens on the phone, write this URL to the NFC card:
   http://YOUR-PC-IP/LifeVault-NFC-Prototype/?id=ARYAN001

8. Tap the NFC card with the phone.

IMPORTANT:
- This is a demonstration only.
- Do not put real medical information into this prototype.
- Do not expose the test server to the public Internet.
