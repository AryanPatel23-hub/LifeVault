<?php
$profiles = [
    "ARYAN001" => [
        "name" => "Demo User",
        "blood_group" => "B+",
        "allergy" => "Penicillin",
        "condition" => "Asthma",
        "medication" => "Inhaler",
        "emergency_contact" => "Father",
        "contact_phone" => "+91 98765 43210"
    ]
];

$id = $_GET["id"] ?? "ARYAN001";
$profile = $profiles[$id] ?? null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeVault - Emergency Profile</title>
    <style>
        * {
            box-sizing: border-box
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #172033
        }

        .container {
            max-width: 520px;
            margin: 0 auto;
            padding: 24px 16px
        }

        .header {
            text-align: center;
            margin-bottom: 18px
        }

        .logo {
            font-size: 28px;
            font-weight: 800
        }

        .subtitle {
            color: #64748b;
            margin-top: 6px
        }

        .card {
            background: #fff;
            border-radius: 18px;
            padding: 22px;
            box-shadow: 0 8px 30px rgba(15, 23, 42, .08)
        }

        .alert {
            background: #fff3f3;
            border: 1px solid #ffd5d5;
            border-radius: 14px;
            padding: 14px;
            margin-bottom: 18px
        }

        .alert strong {
            display: block;
            margin-bottom: 5px
        }

        .row {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 13px 0;
            border-bottom: 1px solid #edf0f5
        }

        .row:last-child {
            border-bottom: 0
        }

        .label {
            color: #64748b
        }

        .value {
            font-weight: 700;
            text-align: right
        }

        .contact {
            display: block;
            text-decoration: none;
            text-align: center;
            background: #172033;
            color: #fff;
            padding: 14px;
            border-radius: 12px;
            margin-top: 18px;
            font-weight: 700
        }

        .footer {
            text-align: center;
            color: #94a3b8;
            font-size: 12px;
            margin-top: 18px
        }

        .error {
            text-align: center;
            padding: 30px
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">🔐 LifeVault</div>
            <div class="subtitle">Emergency Medical Information</div>
        </div>

        <?php if (!$profile): ?>
            <div class="card error">
                <h2>Profile not found</h2>
                <p>The LifeVault emergency profile ID is invalid or unavailable.</p>
            </div>
        <?php else: ?>
            <div class="alert">
                <strong>🚨 Emergency Profile</strong>
                This page contains information the user has permitted for emergency access.
            </div>

            <div class="card">
                <h2><?= htmlspecialchars($profile["name"]) ?></h2>

                <div class="row">
                    <span class="label">Blood Group</span>
                    <span class="value"><?= htmlspecialchars($profile["blood_group"]) ?></span>
                </div>

                <div class="row">
                    <span class="label">Allergy</span>
                    <span class="value"><?= htmlspecialchars($profile["allergy"]) ?></span>
                </div>

                <div class="row">
                    <span class="label">Medical Condition</span>
                    <span class="value"><?= htmlspecialchars($profile["condition"]) ?></span>
                </div>

                <div class="row">
                    <span class="label">Medication</span>
                    <span class="value"><?= htmlspecialchars($profile["medication"]) ?></span>
                </div>

                <div class="row">
                    <span class="label">Emergency Contact</span>
                    <span class="value"><?= htmlspecialchars($profile["emergency_contact"]) ?></span>
                </div>

                <a class="contact" href="tel:<?= htmlspecialchars($profile["contact_phone"]) ?>">
                    📞 Call Emergency Contact
                </a>
            </div>

            <div class="footer">
                LifeVault is an information-access system, not a diagnosis or treatment system.
            </div>
        <?php endif; ?>
    </div>
</body>

</html>