<a id="readme-top"></a>

<div align="center">

![Laravel](https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/100px-Laravel.svg.png)

</div>

<h1 align="center">ITManager</h1>

<div align="center">

![Tailwind](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![AlpineJS](https://img.shields.io/badge/Alpine%20JS-8BC0D0?style=for-the-badge&logo=alpinedotjs&logoColor=black)
![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Livewire](https://img.shields.io/badge/livewire-4e56a6?style=for-the-badge&logo=livewire&logoColor=white)

Modern web app for equipment management and tracking, using the TALL Stack.

</div>

![Register](https://placehold.co/1920x1280/webp)


## Table of Contents

  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
        <li><a href="#screenshots">Screenshots</a></li>
      </ul>
    </li>
    <li><a href="#license">License</a></li>
  </ol>


## About The Project

This project is a comprehensive web application developed using the TALL Stack (Tailwind CSS, Alpine.js, Laravel, and Livewire) with FilamentPHP to enhance the operational efficiency of the IT department at CNE Santo Domingo. The application serves as a robust tool for managing users, roles, and permissions, as well as for tracking and managing IT equipment and goods within the organization.

**Features**
- User Management: A fully functional user management module that allows for the creation, editing, and deletion of user accounts, ensuring secure access to the app.
- Role and Permission System: An intuitive role-based access control system that enables administrators to define user roles and assign specific permissions.
- IT Equipment Module: A dedicated module for the registration and management of IT equipment, including computers and their specifications.
- Goods Module: A comprehensive module for tracking non-IT assets such as furniture, chairs, racks, and other equipment.

<p align="right"><a href="#readme-top">Back to top ⬆️</a></p>


## Getting Started

### Prerequisites

- **PHP 8.1+**
- **Laravel v10.0+**
- **Livewire v3.0+**

### Installation

1. Clone this repo to your computer:
   ```sh
   git clone git@github.com:MarcosKlender/ITManager.git
   ```
2. Install dependencies with:
   ```sh
   cd ITManager
   composer install
   ```
3. Use this to create your own `.env` file:
   ```sh
   cp .env.example .env
   ```
4. Update the `.env` file with your database credentials and run:
   ```sh
   php artisan migrate --seed
   php artisan key:generate
   ```
5. Launch both local servers and start using the app:
   ```sh
   php artisan serve
   ```

<p align="right"><a href="#readme-top">Back to top ⬆️</a></p>

## Screenshots

![Employees](https://i.ibb.co/hBRVMmf/ITManager-Funcionarios.webp)

![Equipment](https://i.ibb.co/74MVjg6/ITManager-Equipos.webp)

![Goods](https://i.ibb.co/NWh1Rsk/ITManager-Bienes.webp)

## License

Distributed under the MIT License.

<p align="right"><a href="#readme-top">Back to top ⬆️</a></p>
