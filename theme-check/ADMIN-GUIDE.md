# Scathach Website - Admin Guide

## How to Manage Your Website Content

Your website is now set up with easy-to-use content management. You can update images, videos, shows, merch, and albums through the WordPress admin panel without touching any code.

### Accessing the Admin Panel
1. Go to: `http://localhost/scathach/wordpress/wp-admin`
2. Log in with your WordPress username and password
3. You'll see new menu items on the left sidebar: **Gallery**, **Shows**, **Merch**, and **Albums**

---

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

If you need to make changes beyond adding/editing content (like changing colors, layout, or adding new features), contact your web developer.

For WordPress basics, visit: https://wordpress.org/support/
