# CAPTCHA Files

**DO NOT MODIFY FILES WITHIN THIS FOLDER, AS THEY MAY BE OVERWRITTEN DURING CORE UPDATES!**

The CAPTCHA Files directory contains PHP files designed for CAPTCHA functionality inclusion in projects. These CAPTCHAs can be displayed using an HTML image tag, with the session key containing the code as `_HIVE_SITE_COOKIE_."captcha.XXXX"`.

**Usage:**
- Integrate the CAPTCHA PHP files into your project to enable CAPTCHA functionality.
- Display the CAPTCHA image using an HTML image tag with the appropriate source.

**Integration:**
- Ensure proper configuration of session handling in your project.
- Utilize the session key `_HIVE_SITE_COOKIE_."captcha.XXXX"` to link CAPTCHA codes with user sessions.

**Important Notes:**
- Handle session keys securely to prevent misuse or abuse.
- Customize CAPTCHA appearance or complexity to align with project requirements.

**Caution:**
- Regularly update and review the CAPTCHA implementation for enhanced security.
- Implement server-side validation to validate CAPTCHA input securely.