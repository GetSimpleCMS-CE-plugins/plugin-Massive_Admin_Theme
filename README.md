# Massive Admin Theme Plugin Documentation for GetSimple CMS

**Massive Admin Theme** is an advanced plugin for GetSimple CMS Community Edition (CE) that transforms the administrative panel's appearance and introduces a variety of tools to streamline website management. Compatible with PHP 8.x, it offers modern customization options, user management, and enhanced administrative workflows.

## Table of Contents
- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Theme Customization](#theme-customization)
- [Version Notes](#version-notes)
- [Frequently Asked Questions](#frequently-asked-questions)
- [Support and Donations](#support-and-donations)
- [License](#license)

## Features
The Massive Admin Theme plugin provides a wide range of functionalities, including:

- **Responsive Admin Interface**: A panel optimized for both mobile and desktop devices.
- **Graphical Themes**: Multiple predefined color schemes (e.g., "Grape", "Modern-Dark") with support for custom themes.
- **User Management**: Create accounts with email-based login, manage permissions, and hide sections for specific users.
- **White Label**: Customize the logo, footer, panel colors, and navigation links.
- **Backup Tool**: Create backups of specific folders (e.g., plugins or uploads only).
- **Template Engine**: Supports a `settings.json` file for quick configuration option additions.
- **Maintenance Mode**: Enhanced maintenance mode with customizable page content replacement.
- **Plugin Search**: Directly download plugins from the GetSimple CMS CE repository.
- **GDPR Compliance**: Replaces Google Fonts with system fonts (e.g., `system-ui`) and removes external dependencies (e.g., Picsum).
- **SVG Icons**: Uses Unicons in SVG format for better performance.
- **Additional Tools**: CSS style editor, navigation link management, and configurable help sections for users.

## Requirements
- GetSimple CMS Community Edition (latest version recommended).
- PHP 7.4 or higher (fully compatible with PHP 8.x).
- Apache server (recommended) or another server supporting `.htaccess` files (e.g., LiteSpeed; Nginx may require additional configuration).
- Write permissions for plugin and configuration folders in the CMS.

## Installation
1. **Download the Plugin**:
   - Visit the repository: [GetSimpleCMS-CE-plugins/plugin-Massive_Admin_Theme](https://github.com/GetSimpleCMS-CE-plugins/plugin-Massive_Admin_Theme).
   - Download the latest version as a ZIP file or clone the repository.
   - Alternatively, use the built-in plugin search in the GetSimple CMS CE admin panel to download it directly.

2. **Extract and Upload**:
   - Unzip the downloaded file.
   - Upload the `massiveAdmin` folder to the `/plugins/` directory of your GetSimple CMS installation.

3. **Activate the Plugin**:
   - Log in to the GetSimple CMS admin panel.
   - Navigate to **Plugins** and activate **Massive Admin Theme**.

4. **Verify Setup**:
   - Check the plugin settings under the admin panel to ensure it’s running correctly.

## Configuration
After activation, the plugin can be configured via the admin panel:
- **Access Settings**: Go to the **Massive Admin Theme** section in the GetSimple CMS admin panel.
- **General Options**:
  - Select a theme (e.g., "Grape", "Modern-Dark").
  - Customize the logo, footer text, and colors.
- **User Management**:
  - Add or edit users with email-based logins.
  - Assign permissions or hide specific sections.
- **Backup Settings**:
  - Choose folders to include in backups (e.g., plugins, uploads).
- **Maintenance Mode**:
  - Enable maintenance mode and customize the displayed message or page.

The plugin uses a `settings.json` file for advanced configuration. Modify this file in the plugin directory to add custom options if needed.

## Theme Customization
- **Predefined Themes**: Choose from built-in themes like "Grape" or "Modern-Dark" in the settings.
- **Custom Themes**:
  - Create a new theme by adding CSS files to the plugin’s theme directory.
  - Update the `settings.json` file to include your custom theme.
- **White Label**:
  - Upload a custom logo via the settings panel.
  - Adjust colors and navigation links to match your branding.

## Version Notes
- **Version 6.0.1**: This version introduces a significant change by switching snippet storage from XML to JSON format. As a result, **version 6.0.1 is not backward compatible** with previous versions. If you are upgrading from an earlier version, ensure you back up your snippets and test the upgrade in a non-production environment first.

## Frequently Asked Questions
**Q: Is the plugin compatible with PHP 8.x?**  
A: Yes, Massive Admin Theme is fully compatible with PHP 8.x.

**Q: Can I use this plugin on Nginx?**  
A: Yes, but you may need to configure rewrite rules manually, as the plugin relies on `.htaccess` for some features.

**Q: How do I report a bug or suggest a feature?**  
A: Open an issue on the [GitHub repository](https://github.com/GetSimpleCMS-CE-plugins/plugin-Massive_Admin_Theme).

## Support and Donations
If you find Massive Admin Theme helpful, consider supporting its development:
- **Donate via PayPal**: [Support the project](https://www.paypal.com/donate/?hosted_button_id=ZNJRCZGFCLC2Y).
- **Community Support**: Join the GetSimple CMS CE community or check the GitHub repository for assistance.

Your contributions help maintain and improve the plugin!

## License
Massive Admin Theme is released under the [GNU General Public License v3.0](https://www.gnu.org/licenses/gpl-3.0.en.html). See the `LICENSE` file in the repository for details.
