# Deployment Guide

This WordPress theme can be automatically deployed using GitHub Actions.

## Automatic Deployment

Every push to the `main` or `master` branch triggers an automated build that:

1. Creates a clean deployment package
2. Generates a ZIP file
3. Uploads the ZIP as a GitHub artifact (available for 30 days)

### Download Deployment Package

After each push:
1. Go to the **Actions** tab in your GitHub repository
2. Click on the latest workflow run
3. Download the `rebecca-mercier-theme` artifact
4. Upload the ZIP file to your WordPress site via the WordPress admin dashboard

## FTP Deployment (Optional)

To enable automatic FTP deployment to your live site:

1. Go to your GitHub repository **Settings** > **Secrets and variables** > **Actions**
2. Add the following secrets:
   - `FTP_SERVER`: Your FTP server address (e.g., `ftp.yoursite.com`)
   - `FTP_USERNAME`: Your FTP username
   - `FTP_PASSWORD`: Your FTP password

3. Edit `.github/workflows/deploy.yml` and uncomment the FTP deployment step:
   ```yaml
   - name: Deploy to server via FTP
     uses: SamKirkland/FTP-Deploy-Action@v4.3.5
     with:
       server: ${{ secrets.FTP_SERVER }}
       username: ${{ secrets.FTP_USERNAME }}
       password: ${{ secrets.FTP_PASSWORD }}
       server-dir: /wp-content/themes/rebecca-mercier-theme/
       local-dir: ./build/rebecca-mercier-theme/
   ```

4. Push the changes and the theme will automatically deploy on every push

## Manual Deployment

### Via WordPress Dashboard

1. Download the latest ZIP from GitHub Actions artifacts
2. Log into WordPress admin
3. Go to **Appearance** > **Themes** > **Add New** > **Upload Theme**
4. Upload the ZIP file and activate

### Via FTP/SFTP

1. Connect to your server via FTP/SFTP
2. Navigate to `/wp-content/themes/`
3. Upload the entire theme folder
4. Activate the theme in WordPress admin

## Version Control

The theme version is managed in `style.css`. Update the version number when making significant changes:

```css
Version: 1.0.13
```

## Testing Before Deployment

Always test changes locally before pushing to the main branch:

1. Set up a local WordPress installation
2. Clone this repository into `wp-content/themes/`
3. Activate the theme and test all changes
4. Once verified, commit and push to GitHub
