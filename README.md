Silakan buat akun di https://www.twilio.com/

Salin TWILIO_ACCOUNT_SID, TWILIO_AUTH_TOKEN, TWILIO_WHATSAPP_NUMBER ke file .env pada dashboard https://www.twilio.com/console

Masukan nomor whatsapp anda kedalam sandbox pada https://www.twilio.com/console/sms/whatsapp/learn

Salin webhook chatbot auto respon : http://url-api/chatbot (POST) pada sandbox whatsapp di twilio https://www.twilio.com/console/sms/whatsapp/sandbox kemidian save.

Silahkan coba chat pada nomor wa yang terdaftar untuk trial tester

Untuk mengirim broadcast whatsapp gunakan endpoint : http://url-api/broadcast (POST) dengan data 
1. key: From dan value: whatsapp:+6281770xxxx (nomor whatsap yang sudah didaftarkan pada sandbox)
2. key: Body dan value: (Pesan yang akan dikirim)