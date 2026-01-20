# Scathach Website - WordPress Admin Guide

## Getting Started with WordPress

Your Scathach website is powered by WordPress, a powerful content management system that allows you to update content, manage media, and maintain your site without any coding knowledge.

### Accessing the WordPress Admin Panel
1. **Local Development**: `http://localhost/scathach/wordpress/wp-admin`
2. **Live Site**: `https://yourwebsite.com/wp-admin`
3. Log in with your WordPress username and password
4. You'll see the WordPress dashboard with custom menu items: **Gallery**, **Shows**, **Merch**, and **Albums**

### WordPress Dashboard Overview
- **Dashboard**: Homepage with site statistics and quick actions
- **Posts**: Blog posts and news articles
- **Media**: All uploaded images, videos, and files
- **Pages**: Static pages like About, Contact
- **Comments**: Visitor comments (if enabled)
- **Appearance**: Themes, menus, and customization
- **Plugins**: Extend functionality
- **Users**: Manage user accounts and permissions
- **Tools**: Import/export and maintenance tools
- **Settings**: Site configuration

---
## WordPress Basics

### Creating and Managing Pages
**To Add New Pages:**
1. Go to **Pages** → **Add New**
2. Enter the page title (e.g., "About", "Tour Dates")
3. Add content using the WordPress editor:
   - **Paragraph blocks** for text
   - **Image blocks** for photos
   - **Gallery blocks** for multiple images
   - **Video blocks** for embedded videos
4. Use the **Page Attributes** box to set:
   - **Parent Page** (for subpages)
   - **Page Template** (if your theme has custom templates)
   - **Order** (for menu ordering)
5. Click **Publish** or **Update**

**To Edit Pages:**
1. Go to **Pages** → **All Pages**
2. Click on the page title or hover and click **Edit**
3. Make your changes and click **Update**

### Managing Blog Posts/News
**To Add News/Blog Posts:**
1. Go to **Posts** → **Add New**
2. Enter a compelling title
3. Add content using blocks (text, images, videos)
4. Set **Categories** (e.g., "News", "Tour Updates", "Album Releases")
5. Add **Tags** for better organization
6. Set a **Featured Image** for the post thumbnail
7. Choose **Publish** immediately or **Schedule** for future publication

### WordPress Media Library
**Uploading Files:**
1. Go to **Media** → **Add New**
2. Drag and drop files or click **Select Files**
3. WordPress automatically creates different sizes for images
4. Add **Alt Text** for accessibility and SEO

**Organizing Media:**
1. Use the **Media Library** to browse all files
2. Filter by **All media items**, **Images**, **Audio**, **Video**
3. Edit files to add captions, descriptions, and alt text
4. Use the **Bulk Select** option to delete multiple files

### Managing Menus and Navigation
**To Create/Edit Menus:**
1. Go to **Appearance** → **Menus**
2. Click **Create a new menu** or select an existing menu
3. Add items from:
   - **Pages** (your site pages)
   - **Posts** (individual blog posts)
   - **Custom Links** (external URLs)
   - **Categories** (post category archives)
4. Drag to reorder menu items
5. Create **Sub Menu** items by dragging slightly to the right
6. Assign menu to a **Menu Location** (e.g., Primary Menu, Footer Menu)
7. Click **Save Menu**

### User Management
**Adding New Users:**
1. Go to **Users** → **Add New**
2. Fill in user details:
   - **Username** (cannot be changed later)
   - **Email** (for notifications and password resets)
   - **First/Last Name**
   - **Website**
3. Choose **Role**:
   - **Administrator**: Full access to everything
   - **Editor**: Can publish and manage posts and pages
   - **Author**: Can publish and manage their own posts
   - **Contributor**: Can write and manage own posts but cannot publish
   - **Subscriber**: Can only manage their profile

**User Profiles:**
- Users can edit their profiles under **Users** → **Your Profile**
- Update bio, social media links, and profile picture
- Change password and email preferences

---

## Scathach-Specific Content Management
## Managing Gallery Images

**To Add New Gallery Images:**
1. Click **Gallery** → **Add New Image** in the left sidebar
2. Enter a title (this won't be shown on the site, just for your reference)
3. Click **Set Featured Image** on the right
4. Upload your image or select from Media Library
5. Click **Publish**

**To Remove Gallery Images:**
1. Click **Gallery** → **All Gallery Images**
2. Hover over the image you want to remove
3. Click **Trash**

**Note:** Gallery images appear in the order they were published. You can change the publish date to reorder them.

---

## Managing Shows/Venues

**To Add a New Show:**
1. Click **Shows** → **Add New Show**
2. Fill in the **Show Details** box:
   - **Date**: e.g., "Oct 15, 2025"
   - **Venue Name**: e.g., "The Academy"
   - **Location/City**: e.g., "Dublin"
   - **Ticket Purchase Link**: Full URL where people can buy tickets
3. Set a **Featured Image** (this will be the background for the show box)
4. Click **Publish**

**To Edit or Remove Shows:**
1. Click **Shows** → **All Shows**
2. Click on the show to edit, or hover and click **Trash** to remove

---

## Managing Merch Items

**To Add New Merch:**
1. Click **Merch** → **Add New Item**
2. Enter the product name as the title (e.g., "Celtic T-Shirt")
3. Fill in **Merch Details**:
   - **Price**: e.g., "€25.00"
   - **Purchase Link**: URL where people can buy the item
4. In the main text area, you can add a description (optional)
5. Set a **Featured Image** (product photo)
6. Click **Publish**

**To Edit or Remove Merch:**
1. Click **Merch** → **All Merch**
2. Click to edit or trash items

---

## Managing Albums/Music

**To Add a New Album:**
1. Click **Albums** → **Add New Album**
2. Enter the album title (e.g., "ECHOES", "SHADOWS", "WARRIORS")
3. Fill in **Album Details**:
   - **Spotify Link**: Link to the album on Spotify
   - **Apple Music Link**: Link to Apple Music
   - **Listen Now Link**: Primary streaming link
4. Set a **Featured Image** (album artwork)
5. Click **Publish**

**To Edit or Remove Albums:**
1. Click **Albums** → **All Albums**
2. Click to edit or trash items

---

## Changing Images and Videos

### Background Video (behind venues section)
1. Go to **Media** → **Add New**
2. Upload your new video file (MP4 format recommended)
3. Once uploaded, click on the video
4. Copy the **File URL**
5. You'll need to update the theme file `front-page.php` - contact your developer for this change, or use an FTP client to replace the video file with the same name: `scathachVideo1.mp4` in the `/wp-content/themes/scathach-theme/videos/` folder

### Replacing Images in Theme
For images that are part of the design (logos, backgrounds):
1. Use an FTP client or File Manager
2. Navigate to `/wp-content/themes/scathach-theme/images/`
3. Replace the image file with your new one **using the exact same filename**
4. The image will automatically update on the site

---

## WordPress Maintenance & Security

### Regular Backups
**Why Backup:**
- Protect against data loss
- Safe testing of changes
- Quick recovery from problems

**Backup Methods:**
1. **Plugin-Based**: Install a backup plugin like UpdraftPlus or BackWPup
2. **Manual**: Download files via FTP and export database from phpMyAdmin
3. **Host-Based**: Many hosting providers offer automatic backups

**What to Backup:**
- WordPress files (`wp-content` folder especially)
- Database (all your content and settings)
- wp-config.php file

### Security Best Practices
**Strong Passwords:**
- Use complex passwords for all user accounts
- Consider a password manager
- Change passwords regularly

**User Security:**
- Remove unused user accounts
- Use appropriate user roles (don't give everyone Admin access)
- Monitor user activity

**WordPress Updates:**
- Keep WordPress core updated
- Update plugins and themes regularly
- Test updates on a staging site first

**Security Plugins:**
Consider installing security plugins like:
- Wordfence Security
- Sucuri Security
- iThemes Security

### Performance Optimization
**Image Optimization:**
- Resize images before uploading
- Use WebP format when possible
- Install an image optimization plugin

**Caching:**
- Install a caching plugin (WP Rocket, W3 Total Cache)
- Enable browser caching
- Use a Content Delivery Network (CDN)

**Database Maintenance:**
- Remove spam comments regularly
- Clean up unused plugins and themes
- Optimize database tables monthly

### Troubleshooting Common Issues
**Site is Down:**
1. Check hosting server status
2. Look for plugin conflicts (deactivate all, test, reactivate one by one)
3. Switch to default theme temporarily
4. Check error logs

**Can't Log In:**
1. Reset password via "Forgot Password"
2. Access via FTP and reset user in database
3. Check wp-config.php file permissions

**Slow Loading:**
1. Install a performance testing plugin
2. Optimize images
3. Enable caching
4. Check for resource-heavy plugins

---

## Tips for Best Results

- **Image Sizes**: 
  - Gallery images: at least 1200px wide
  - Merch images: square format, 800x800px or larger
  - Album covers: square format, 1000x1000px minimum
  - Show backgrounds: 1920x1080px or similar landscape format

- **Video Format**: MP4 (H.264) for best browser compatibility

- **Order Control**: Items appear in the order they were published. To reorder, edit the item and change the publish date

- **Always Set Featured Images**: These are the main images that appear on your site

---

## Getting Help

### WordPress Resources
- **Official Documentation**: https://wordpress.org/support/
- **WordPress Codex**: https://codex.wordpress.org/
- **WordPress.com Support**: https://wordpress.com/support/
- **WordPress Forums**: https://wordpress.org/support/forums/
- **WordPress.tv**: Free videos and tutorials

### Scathach Theme Support
For changes beyond content management (colors, layout, new features), contact your web developer.

### Common WordPress Commands
**Useful Admin URLs:**
- `/wp-admin/` - Admin dashboard
- `/wp-admin/edit.php` - All posts
- `/wp-admin/edit.php?post_type=page` - All pages
- `/wp-admin/upload.php` - Media library
- `/wp-admin/themes.php` - Themes
- `/wp-admin/plugins.php` - Plugins
- `/wp-admin/users.php` - Users

### Emergency Access
If locked out of WordPress:
1. Access via FTP/cPanel File Manager
2. Navigate to `/wp-content/themes/`
3. Rename your active theme folder to deactivate it
4. WordPress will revert to default theme
5. Access admin and fix the issue

### Regular Maintenance Checklist
**Weekly:**
- Check for WordPress, theme, and plugin updates
- Review and moderate comments
- Check site functionality

**Monthly:**
- Create full site backup
- Review user accounts and permissions
- Check Google Analytics and site performance
- Clean up media library

**Quarterly:**
- Review and update content
- Check all forms and contact methods
- Review security settings
- Audit plugins (remove unused ones)
