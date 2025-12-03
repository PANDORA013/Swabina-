# CRUD System Testing Guide

**Purpose**: Verify that all admin CRUD modules are working correctly with proper delete, edit, and create functionality.

---

## Quick Test Procedure

### 1. News/Berita Module Test

```bash
# 1. Navigate to admin berita page
http://localhost/admin/berita

# 2. Click "Tambah Berita" button
# Expected: Create form appears

# 3. Fill form:
Title: "Test Berita - December 4"
Description: "This is a test berita entry"
Image: Select any image

# 4. Click "Simpan"
# Expected: Success message, redirected to index with new entry shown

# 5. Click "Edit" button on the new entry
# Expected: Edit form pre-filled with data

# 6. Change title to "Test Berita Updated"
# 7. Click "Update"
# Expected: Success message, title updated

# 8. Click "Hapus" button
# Expected: Confirmation dialog appears
# 9. Confirm deletion
# Expected: Success message, entry removed from list, image deleted from storage
```

### 2. FAQ Module Test

```bash
# 1. Navigate to admin FAQ
http://localhost/admin/faq

# 2. Click "Tambah FAQ"
# Expected: Create form appears

# 3. Fill form:
Question: "Test question?"
Answer: "Test answer here"

# 4. Click "Simpan"
# Expected: Success message, FAQ added to list

# 5. Click "Edit"
# Expected: Pre-filled form

# 6. Change question to "Updated question?"
# 7. Click "Update"
# Expected: Changes saved

# 8. Click "Hapus"
# Expected: Confirmation dialog, then deletion success message
```

### 3. Certificates (Sertifikat) Module Test

```bash
# 1. Navigate to certificates
http://localhost/admin/sertifikat

# 2. Click "Tambah Sertifikat"
# Expected: Create form appears

# 3. Fill form:
Nama: "Test Certificate"
Deskripsi: "Test certificate description"
Image: Select image

# 4. Click "Simpan"
# Expected: Success, entry appears in list

# 5. Verify image was uploaded:
Check: storage/app/public/sertifikats/ folder
# Expected: Image file exists with timestamp prefix

# 6. Click "Edit", change image, click "Update"
# Expected: Old image deleted, new image uploaded

# 7. Click "Hapus"
# Expected: Deletion success, image deleted from folder
```

### 4. Services (Layanan) Module Test

```bash
# 1. Navigate to services
http://localhost/admin/layanan

# 2. View pre-defined services
# Expected: 6 service pages listed (Swa Academy, Facility Management, etc.)

# 3. Click "Edit" on one service
# Expected: Edit form appears pre-filled

# 4. Change title, description, or image
# 5. Click "Update"
# Expected: Changes saved, image replaced if updated

# 6. Test status toggle:
Click checkbox next to service name
# Expected: Service status changes (visible on frontend if active)

# 7. Click "Hapus" button
# Expected: Confirmation, deletion success, image deleted
```

### 5. Timeline (Jejak Langkah) Module Test

```bash
# 1. Navigate to timeline
http://localhost/admin/jejak-langkah

# 2. Click "Tambah Timeline"
# Expected: Create form appears

# 3. Fill form:
Tahun: 2024
Deskripsi: "Test milestone description"
Image: Select image

# 4. Click "Simpan"
# Expected: Success, entry added (ordered by year descending)

# 5. Check storage/app/public/jejak_langkah/ folder
# Expected: Image file exists

# 6. Test edit and update
# Expected: Works same as other modules

# 7. Test delete with confirmation
# Expected: Entry and image deleted
```

### 6. Why Choose Us Module Test

```bash
# 1. Navigate to why choose us
http://localhost/admin/why-choose-us

# 2. Click "Tambah Item"
# Expected: Create form appears

# 3. Fill form:
Title: "Test Feature"
Description: "Feature description"
Icon: Select icon image
Order: 1
Status: Active

# 4. Click "Simpan"
# Expected: Success, item added to list

# 5. Test edit/update functionality
# Expected: All fields update correctly

# 6. Test delete with confirmation
# Expected: Item removed, icon deleted from storage
```

### 7. Social Media Links Test (Special Case - No Delete)

```bash
# 1. Navigate to social media
http://localhost/admin/social-media

# 2. View all social media links
# Expected: See current links for all platforms (or "-" if empty)

# 3. Click "Edit Social Media" button
# Expected: Form shows all 6 fields with current values

# 4. Update one field (e.g., Facebook URL)
# 5. Click "Simpan Perubahan"
# Expected: Success message, changes reflected on view

# 6. Check that View cache was cleared:
Visit website homepage or social links widget
# Expected: Updated links appear on frontend

# Note: No delete button for individual links - only edit entire table
```

---

## Error Cases to Test

### Test: Invalid Data Entry

```bash
# 1. Go to any CRUD module
# 2. Try to submit empty required field
# Expected: Validation error message appears above form

# 3. For image fields, try uploading non-image file
# Expected: Error message "must be image"

# 4. For image fields, try uploading file > 2MB
# Expected: Error message about file size
```

### Test: File Storage

```bash
# 1. After each upload, check storage folder:
storage/app/public/beritas/
storage/app/public/sertifikats/
storage/app/public/jejak_langkah/
storage/app/public/why_choose_us/
storage/app/public/layanan/

# Expected: Files exist with timestamp prefix: "1733300000_filename.ext"
# Expected: Old files deleted when record updated or deleted
```

### Test: Permissions/Access Control

```bash
# 1. Log in as user WITHOUT "manage_news" privilege
# 2. Try to access /admin/berita
# Expected: Access denied error or redirected

# 3. Log in as user WITH privilege
# Expected: Can access and perform CRUD operations
```

---

## Database Verification

After testing each module, verify database:

```sql
-- Check News entries
SELECT * FROM beritas ORDER BY created_at DESC;

-- Check FAQ entries  
SELECT * FROM faqs ORDER BY created_at DESC;

-- Check Certificates
SELECT * FROM sertifikats ORDER BY created_at DESC;

-- Check Timeline entries
SELECT * FROM jejak_langkahs ORDER BY tahun DESC;

-- Check Why Choose Us items
SELECT * FROM why_choose_us ORDER BY order ASC;

-- Check Social Links
SELECT * FROM social_links WHERE id = 1;
```

---

## Storage Folder Verification

```bash
# Command line check (Windows PowerShell):
Get-ChildItem "c:\xampp\htdocs\project_magang\storage\app\public" -Recurse | 
  Select-Object FullName | 
  Sort-Object

# Expected structure:
storage/app/public/
├── beritas/
├── sertifikats/
├── jejak_langkah/
├── why_choose_us/
└── layanan/
```

---

## Expected Flash Messages

When operations complete, users should see:

### Success Messages:
- ✅ "Berita berhasil ditambahkan"
- ✅ "Berita berhasil diperbarui"
- ✅ "Berita berhasil dihapus"
- ✅ "FAQ berhasil ditambahkan"
- ✅ "FAQ berhasil diperbarui"
- ✅ "FAQ berhasil dihapus"
- ✅ (Similar for other modules)

### Error Messages:
- ❌ Validation errors appear above form
- ❌ Database error message if operation fails
- ❌ "File not found" if image not detected

---

## Performance Checks

### 1. Image Optimization
```bash
# After uploading images, verify they're being served efficiently:
# Check image file sizes in storage folder
# Expected: Images should be reasonable size (< 2MB each)
```

### 2. Database Queries
```bash
# Enable query logging in config/logging.php
# Expected: Each CRUD operation should use minimal queries
# - Index: 1 query to fetch records
# - Create: 1 query to insert
# - Update: 1 query to update
# - Delete: 2 queries (1 fetch, 1 delete)
```

### 3. File Operations
```bash
# Expected: File upload/delete operations complete < 1 second
# Expected: Storage folder doesn't grow excessively
# Verify old files are deleted properly on update/delete
```

---

## Test Summary Checklist

### News/Berita
- [ ] Create new entry
- [ ] Read/View entry in list
- [ ] Edit entry
- [ ] Update entry
- [ ] Delete entry with confirmation
- [ ] Image uploaded correctly
- [ ] Old image deleted on update
- [ ] Old image deleted on destroy
- [ ] Validation error messages appear
- [ ] Success messages appear

### FAQ
- [ ] Create FAQ
- [ ] Edit FAQ
- [ ] Update FAQ
- [ ] Delete FAQ
- [ ] (Note: No image upload for FAQ)

### Sertifikat
- [ ] (Same as News/Berita)
- [ ] Image stored in sertifikats/ folder
- [ ] Certificate appears on frontend

### Layanan
- [ ] View all services
- [ ] Edit service
- [ ] Update service with image
- [ ] Delete service
- [ ] Toggle service status
- [ ] Service visibility on frontend reflects status

### Jejak Langkah
- [ ] Create timeline entry
- [ ] Edit timeline entry
- [ ] Delete timeline entry
- [ ] Entries ordered by year (descending)
- [ ] Image stored in jejak_langkah/ folder

### Why Choose Us
- [ ] Create item
- [ ] Edit item
- [ ] Delete item
- [ ] Icon uploaded correctly
- [ ] Order field works for sorting
- [ ] Status field controls visibility

### Social Media
- [ ] View all social links
- [ ] Edit social links
- [ ] Update links
- [ ] No delete button present (correct)
- [ ] Frontend displays updated links

---

## Troubleshooting

### Issue: Delete button not working
**Solution**: 
- Check route is registered: `php artisan route:list | Select-String "destroy"`
- Verify @method('DELETE') in form
- Check DELETE method is allowed in middleware

### Issue: Image not uploading
**Solution**:
- Check storage folder permissions: `chmod 755 storage/app/public`
- Verify file upload size limit in php.ini
- Check image validation rules

### Issue: Deleted file still exists
**Solution**:
- Check Storage::disk('public')->delete() is in destroy method
- Verify file path is correct
- Check file permissions

### Issue: Validation errors not showing
**Solution**:
- Check error bag is displayed in view
- Verify form includes `@if($errors->any())`
- Check field names match validation rules

---

## Success Criteria

✅ All tests pass when:
1. All CRUD operations work without errors
2. Database records update correctly
3. Files upload and delete properly
4. Flash messages appear appropriately
5. Form validation prevents invalid data
6. Permission middleware blocks unauthorized access
7. Frontend displays updated content
8. Storage folders maintain correct structure

---

**Test Date**: _______________  
**Tester Name**: _______________  
**Results**: ✅ PASSED / ❌ FAILED  
**Notes**: _______________

---

Last Updated: December 4, 2025
