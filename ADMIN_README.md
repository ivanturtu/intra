# Admin Panel - INTRA Studio

Backoffice administration panel built with Livewire 3 for managing website content.

## Features

### Projects Management
- **CRUD Operations**: Create, Read, Update, Delete projects
- **Image Management**: Upload and manage main image, selected image, and image gallery
- **Team Members**: Dynamic team member fields (name and role) that can be added/removed
- **Team Leads**: Multiselect from Team table for INTRAstudio Team Leads
- **Project Fields**:
  - Main image
  - Title
  - Short description
  - Sector
  - Client
  - Location
  - Year
  - Quote
  - Image gallery (multiple images)
  - Description
  - Selected image
  - Team members (dynamic rows with name and role)
  - INTRAstudio Team Leads (multiselect)
  - Category
  - Order
  - Published status

## Setup

1. **Run migrations**:
```bash
php artisan migrate
```

2. **Create storage link** (if not already created):
```bash
php artisan storage:link
```

3. **Access the admin panel**:
Navigate to `/admin/projects` in your browser

## Routes

- `/admin/projects` - List all projects
- `/admin/projects/create` - Create new project
- `/admin/projects/{id}/edit` - Edit existing project

## Database Structure

### Projects Table
- `id` - Primary key
- `main_image` - Main project image path
- `title` - Project title
- `short_description` - Short description
- `sector` - Project sector
- `client` - Client name
- `location` - Project location
- `year` - Project year
- `quote` - Project quote
- `image_gallery` - JSON array of image paths
- `description` - Full project description
- `selected_image` - Selected image path
- `team_members` - JSON array of team member objects (name, role)
- `category` - Project category
- `order` - Display order
- `is_published` - Published status
- `created_at`, `updated_at` - Timestamps

### Teams Table
- `id` - Primary key
- `name` - Team member name
- `role` - Team member role
- `bio` - Biography
- `email` - Email address
- `photo` - Photo path
- `created_at`, `updated_at` - Timestamps

### Project-Team Pivot Table
- `id` - Primary key
- `project_id` - Foreign key to projects
- `team_id` - Foreign key to teams
- `created_at`, `updated_at` - Timestamps

## File Storage

All uploaded images are stored in:
- `storage/app/public/projects/` - Main and selected images
- `storage/app/public/projects/gallery/` - Gallery images

Make sure the storage link is created: `php artisan storage:link`

## Next Steps

- Add authentication/authorization
- Add Team management CRUD
- Add image optimization
- Add bulk operations
- Add export functionality
