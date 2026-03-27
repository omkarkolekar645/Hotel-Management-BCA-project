# Hotel-Management-System

Simple hotel booking website with content management system. Users can book rooms for specific dates. Admin can create, update, and delete room details. Admin can manage everything in the app.


## Tech Stack 
- HTML
- CSS
- JAVASCRIPT
- PHP
- BOOTSTRAP 

---

## 🛠️ Installation Guidelines

### Requirements for Windows:
1. **Download & Install:** Install [XAMPP](https://www.apachefriends.org/) in `C:\xampp` (default).
2. **Clone Repository:** Clone this repository in `C:\xampp\htdocs`.
3. **Start Server:** Run XAMPP and start the **Apache** and **MySQL** services.
4. **Database Setup:** 
   - Open your browser and go to `localhost/phpmyadmin/`.
   - Click on **New** at the sidebar and create a database named `bluebirdhotel`.
   - After creating the database, click the **Import** tab and select the file `bluebirdhotel.sql` located in your project folder.
5. **Launch:** Open the link `http://localhost/Hotel-Management-System/` in your browser.
6. Now you can register and login!

### Requirements for Linux [Rocky Linux 9]:
1. **Install Package Manager:** Install the `dnf` package manager if not already present.
2. **Clone Repository:** Clone this repository in your home directory.
3. **Set Permissions:** Enable execute permissions on `setup.sh` by running:
   ```sh
   chmod 755 setup.sh
   ```
4. **Root Access:** Login as root or use:
   ```sh
   sudo su - root
   ```
5. **Run Setup:** Run the setup script:
   ```sh
   ./setup.sh
   ```
6. **Launch:** Open the link `http://localhost/Hotel-Management-System/` in your browser.
7. Now you can register and login!

---

## 🔐 Default Logins

Here are the default credentials provided for the admin portal:

**== Staff Login ==**
- **Email:** `Admin@gmail.com`
- **Password:** `1234`

---

## 📖 User Guide

### For Guests (Users)
- **Registration & Login:** Go to the home page, select Sign Up/Register, and provide a Username, Email, and Password. Login to access booking features.
- **Booking a Room:** Navigate to the Reservation section. Select a Room Type and Bed Type, fill in your dates (Check-in / Check-out), and submit your request. 

### For Administrators & Managers
- **Admin Login:** Navigate to the `/admin` portal (or staff login page) and use the Staff Login detailed above.
- **Managing Bookings:** From the Manager Panel, review pending guest room requests and mark them as `Confirm`.
- **Managing Payments:** Generate bills based on the guest's room data, calculating room total, bed total, and meal charges.
- **Managing Staff:** Keep track of the team including Managers, Cooks, Cleaners, and Waiters in the Staff panel.
