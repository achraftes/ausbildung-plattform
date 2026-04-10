app/
 ├── Http/
 │    ├── Controllers/
 │    │    ├── AuthController.php
 │    │    ├── CVController.php
 │    │    ├── AdviceController.php
 │    │    ├── ChatbotController.php
 │    │    └── AusbildungController.php
 │
 ├── Models/
 │    ├── User.php
 │    ├── CV.php
 │    ├── Advice.php
 │    └── ChatbotLog.php
 │
database/
 └── migrations/
resources/
 ├── views/
 │    ├── layouts/
 │    │    └── app.blade.php
 │    ├── auth/
 │    │    ├── login.blade.php
 │    │    └── register.blade.php
 │    ├── dashboard.blade.php
 │    ├── ausbildung.blade.php
 │    ├── cv-builder.blade.php
 │    ├── advices.blade.php
 │    └── chatbot.blade.php
routes/
 └── web.php