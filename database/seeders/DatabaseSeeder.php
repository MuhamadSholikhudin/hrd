<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Job;
use App\Models\User;
use App\Models\Investigation;
use App\Models\Menu;
use App\Models\Sub_menu;
use App\Models\Role;
use App\Models\Access_menu;
use App\Models\Method;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // Employee::factory(50000)->create();
        // User::factory(1)->create();
        
        // Investigation::factory(30000)->create();
        User::create([ 
            "name" => "admin",
            "email" => "admin@gmail.com",
            "password" => bcrypt("admin"),
            "role_id" => 1,
            "is_active" => 1,
        ]);


        Department::create([ "department" => "ACCOUNTING"]);
        Department::create([ "department" => "ASSEMBLY"]);
        Department::create([ "department" => "ASSEMBLY-A"]);
        Department::create([ "department" => "ASSEMBLY-B"]);
        Department::create([ "department" => "ASSEMBLY-C"]);
        Department::create([ "department" => "ASSEMBLY-D"]);
        Department::create([ "department" => "ASSEMBLY-D1"]);
        Department::create([ "department" => "ASSEMBLY-D2"]);
        Department::create([ "department" => "ASSEMBLY-E1"]);
        Department::create([ "department" => "ASSEMBLY-E2"]);
        Department::create([ "department" => "ASSEMBLY-H"]);
        Department::create([ "department" => "CHEMICAL ENGINEERING"]);
        Department::create([ "department" => "CUTTING"]);
        Department::create([ "department" => "CUTTING-A"]);
        Department::create([ "department" => "CUTTING-B"]);
        Department::create([ "department" => "CUTTING-C"]);
        Department::create([ "department" => "CUTTING-D1"]);
        Department::create([ "department" => "CUTTING-D2"]);
        Department::create([ "department" => "CUTTING-E1"]);
        Department::create([ "department" => "CUTTING-E2"]);
        Department::create([ "department" => "CUTTING-H"]);
        Department::create([ "department" => "DEVELOPMENT"]);
        Department::create([ "department" => "EMBOSS"]);
        Department::create([ "department" => "ENGINEERING"]);
        Department::create([ "department" => "EPTE"]);
        Department::create([ "department" => "EXIM"]);
        Department::create([ "department" => "FACTORY MGR A"]);
        Department::create([ "department" => "FACTORY MGR C"]);
        Department::create([ "department" => "FACTORY MGR D"]);
        Department::create([ "department" => "FACTORY MGR E"]);
        Department::create([ "department" => "FINISH GOOD"]);
        Department::create([ "department" => "FINISH GOOD A"]);
        Department::create([ "department" => "FINISH GOOD C"]);
        Department::create([ "department" => "FINISH GOOD D"]);
        Department::create([ "department" => "FINISH GOOD E"]);
        Department::create([ "department" => "FINISH GOOD H"]);
        Department::create([ "department" => "FINISH GOOD O"]);
        Department::create([ "department" => "GA"]);
        Department::create([ "department" => "GA (DRIVER)"]);
        Department::create([ "department" => "GA (KEBERSIHAN)"]);
        Department::create([ "department" => "GA (MESS)"]);
        Department::create([ "department" => "GA (SECURITY)"]);
        Department::create([ "department" => "GA (SIPIL)"]);
        Department::create([ "department" => "GA (WWTP)"]);
        Department::create([ "department" => "GUDANG MATERIAL"]);
        Department::create([ "department" => "HRD"]);
        Department::create([ "department" => "IE"]);
        Department::create([ "department" => "IT"]);
        Department::create([ "department" => "LABORAT "]);
        Department::create([ "department" => "LAMINATING"]);
        Department::create([ "department" => "MAGANG"]);
        Department::create([ "department" => "MARKETING"]);
        Department::create([ "department" => "ME"]);
        Department::create([ "department" => "MT"]);
        Department::create([ "department" => "PPIC"]);
        Department::create([ "department" => "PRODUCTION DIRECTOR"]);
        Department::create([ "department" => "PURCHASING"]);
        Department::create([ "department" => "QIP"]);
        Department::create([ "department" => "QIP-A"]);
        Department::create([ "department" => "QIP-B"]);
        Department::create([ "department" => "QIP-C"]);
        Department::create([ "department" => "QIP-D"]);
        Department::create([ "department" => "QIP-E"]);
        Department::create([ "department" => "QIP-F"]);
        Department::create([ "department" => "QIP-G"]);
        Department::create([ "department" => "QIP-H"]);
        Department::create([ "department" => "QIP-M"]);
        Department::create([ "department" => "QIP-S"]);
        Department::create([ "department" => "QSM"]);
        Department::create([ "department" => "SABLON"]);
        Department::create([ "department" => "SABLON EMBOSS"]);
        Department::create([ "department" => "SEA"]);
        Department::create([ "department" => "SERIKAT NON-JOB"]);
        Department::create([ "department" => "SEWING COMP"]);
        Department::create([ "department" => "SEWING COMP A"]);
        Department::create([ "department" => "SEWING COMP B"]);
        Department::create([ "department" => "SEWING COMP C"]);
        Department::create([ "department" => "SEWING COMP D"]);
        Department::create([ "department" => "SEWING COMP D1"]);
        Department::create([ "department" => "SEWING COMP D2"]);
        Department::create([ "department" => "SEWING COMP E1"]);
        Department::create([ "department" => "SEWING COMP E"]);
        Department::create([ "department" => "SEWING COMP E2"]);
        Department::create([ "department" => "SEWING COMP H"]);
        Department::create([ "department" => "SEWING MEKANIK"]);
        Department::create([ "department" => "SEWING MEKANIK A"]);
        Department::create([ "department" => "SEWING MEKANIK B"]);
        Department::create([ "department" => "SEWING MEKANIK C"]);
        Department::create([ "department" => "SEWING MEKANIK D"]);
        Department::create([ "department" => "SEWING MEKANIK D1"]);
        Department::create([ "department" => "SEWING MEKANIK D2"]);
        Department::create([ "department" => "SEWING MEKANIK E"]);
        Department::create([ "department" => "SEWING MEKANIK E1"]);
        Department::create([ "department" => "SEWING MEKANIK E2"]);
        Department::create([ "department" => "SEWING MEKANIK H"]);
        Department::create([ "department" => "SEWING"]);
        Department::create([ "department" => "SEWING-A"]);
        Department::create([ "department" => "SEWING-B"]);
        Department::create([ "department" => "SEWING-C"]);
        Department::create([ "department" => "SEWING-D"]);
        Department::create([ "department" => "SEWING-D1"]);
        Department::create([ "department" => "SEWING-D2"]);
        Department::create([ "department" => "SEWING-E"]);
        Department::create([ "department" => "SEWING-E1"]);
        Department::create([ "department" => "SEWING-E2"]);
        Department::create([ "department" => "SEWING-H"]);
        Department::create([ "department" => "SMART"]);
        Department::create([ "department" => "STOCKFIT"]);
        Department::create([ "department" => "TECHNICAL"]);
        Department::create([ "department" => "TECHNICAL HOTPRESS"]);
        Department::create([ "department" => "TECHNICAL LAB"]);
        Department::create([ "department" => "TECHNICAL ROLLING COMPOUND"]);
        Department::create([ "department" => "TECHNICAL SUPERMARKET"]);
        Department::create([ "department" => "TRAINING"]);
        Department::create([ "department" => "TRAINING CENTER"]);
        Department::create([ "department" => "NONE"]);
        
        Job::create(["code_job_level" => "PD", "job_level" => "PRESIDEN DIREKTUR", "level" => "1"]);
        Job::create(["code_job_level" => "SD", "job_level" => "SENIOR DIREKTUR", "level" => "2"]);
        Job::create(["code_job_level" => "DIR", "job_level" => "DIREKTUR", "level" => "3"]);
        Job::create(["code_job_level" => "DIRP", "job_level" => "DIREKTUR PRODUKSI", "level" => "3"]);
        Job::create(["code_job_level" => "ASDIR", "job_level" => "ASISTEN DIREKTUR", "level" => "4"]);
        Job::create(["code_job_level" => "SM", "job_level" => "SENIOR MANAGER", "level" => "5"]);
        Job::create(["code_job_level" => "AMA", "job_level" => "ASISTEN MANAGER A", "level" => "6"]);
        Job::create(["code_job_level" => "MGRA", "job_level" => "MANAGER A", "level" => "6"]);
        Job::create(["code_job_level" => "FMGR", "job_level" => "FACTORY MANAGER", "level" => "7"]);
        Job::create(["code_job_level" => "GMGR", "job_level" => "GENERAL MANAGER", "level" => "7"]);
        Job::create(["code_job_level" => "AMI", "job_level" => "ASISTEN MANAGER I", "level" => "8"]);
        Job::create(["code_job_level" => "AM", "job_level" => "ASST. MANAGER", "level" => "8"]);
        Job::create(["code_job_level" => "MGRI", "job_level" => "MANAGER", "level" => "8"]);
        Job::create(["code_job_level" => "DOK", "job_level" => "DOKTER", "level" => "8"]);
        Job::create(["code_job_level" => "SPV", "job_level" => "SUPERVISOR", "level" => "9"]);
        Job::create(["code_job_level" => "ASPV", "job_level" => "ASST. SUPERVISOR", "level" => "9"]);
        Job::create(["code_job_level" => "LD", "job_level" => "LEADER", "level" => "10"]);
        Job::create(["code_job_level" => "SST", "job_level" => "SENIOR STAFF", "level" => "10"]);
        Job::create(["code_job_level" => "ST", "job_level" => "STAFF", "level" => "11"]);
        Job::create(["code_job_level" => "STO", "job_level" => "STAFF OPERATOR", "level" => "11"]);
        Job::create(["code_job_level" => "PWT", "job_level" => "PERAWAT", "level" => "11"]);
        Job::create(["code_job_level" => "DRV", "job_level" => "DRIVER", "level" => "12"]);
        Job::create(["code_job_level" => "OP", "job_level" => "OPERATOR", "level" => "12"]);
        Job::create(["code_job_level" => "HLP", "job_level" => "HELPER", "level" => "12"]);
        Job::create(["code_job_level" => "NO", "job_level" => "NONE", "level" => "13"]);

        Menu::create(["menu" => "Dashboard"]);
        Menu::create(["menu" => "Datamaster"]);
        Menu::create(["menu" => "HI"]);
        Menu::create(["menu" => "Management Akses"]);
      
        Sub_menu::create(["menu_id" => 1, "title" => "Dashboard", "url" => "/dashboards", "icon" => "fas fa-circle", "is_active" => 1]);

        Sub_menu::create(["menu_id" => 2, "title" => "Karyawan", "url" => "/employees", "icon" => "fas fa-circle", "is_active" => 1]);
        Sub_menu::create(["menu_id" => 2, "title" => "Promosi", "url" => "/promotions", "icon" => "fas fa-circle", "is_active" => 1]);
        Sub_menu::create(["menu_id" => 2, "title" => "Demosi", "url" => "/demotions", "icon" => "fas fa-circle", "is_active" => 1]);
        Sub_menu::create(["menu_id" => 2, "title" => "Mutasi", "url" => "/mutations", "icon" => "fas fa-circle", "is_active" => 1]);
        Sub_menu::create(["menu_id" => 2, "title" => "Job Level", "url" => "/jobs", "icon" => "fas fa-circle", "is_active" => 1]);
        Sub_menu::create(["menu_id" => 2, "title" => "Departement", "url" => "/departments", "icon" => "fas fa-circle", "is_active" => 1]);

        Sub_menu::create(["menu_id" => 4, "title" => "Users", "url" => "/users", "icon" => "fas fa-circle", "is_active" => 1]);
        Sub_menu::create(["menu_id" => 4, "title" => "Roles", "url" => "/roles", "icon" => "fas fa-circle", "is_active" => 1]);
        Sub_menu::create(["menu_id" => 4, "title" => "Menu", "url" => "/menus", "icon" => "fas fa-circle", "is_active" => 1]);
        Sub_menu::create(["menu_id" => 4, "title" => "Sub Menu", "url" => "/sub_menus", "icon" => "fas fa-circle", "is_active" => 1]);

        Sub_menu::create(["menu_id" => 3, "title" => "Master Pelanggaran", "url" => "/hiviolations", "icon" => "fas fa-circle", "is_active" => 1]);
        Sub_menu::create(["menu_id" => 3, "title" => "Pelanggaran Karyawan", "url" => "/violations", "icon" => "fas fa-circle", "is_active" => 1]);
        Sub_menu::create(["menu_id" => 3, "title" => "PHK", "url" => "/layoffs", "icon" => "fas fa-circle", "is_active" => 1]);
        Sub_menu::create(["menu_id" => 3, "title" => "Manager HRD", "url" => "/signatures", "icon" => "fas fa-circle", "is_active" => 1]);
        Sub_menu::create(["menu_id" => 3, "title" => "Pasal PKB", "url" => "/articles", "icon" => "fas fa-circle", "is_active" => 1]);
        Sub_menu::create(["menu_id" => 3, "title" => "Ayat PKB", "url" => "/paragraphs", "icon" => "fas fa-circle", "is_active" => 1]);
        Sub_menu::create(["menu_id" => 3, "title" => "Huruf PKB", "url" => "/alphabets", "icon" => "fas fa-circle", "is_active" => 1]);
 
        Role::create(["role" => "Super Admin"]);
        Role::create(["role" => "Admin"]);
        Role::create(["role" => "HI"]);
        Role::create(["role" => "Payroll"]);
        Role::create(["role" => "Recruitment"]);
        Role::create(["role" => "Training"]);

        Access_menu::create(["role_id" => 1, "menu_id" => 1]);
        // Access_menu::create(["role_id" => 1, "menu_id" => 2]);
        // Access_menu::create(["role_id" => 1, "menu_id" => 3]);
        Access_menu::create(["role_id" => 1, "menu_id" => 4]);


        Method::create(["access_menu_id" => 1, "sub_menu_id" => 1, "edit" => "true", "delete" => "true", "view" => "true"]);
        
        Method::create(["access_menu_id" => 2, "sub_menu_id" => 8, "edit" => "true", "delete" => "true", "view" => "true"]);
        Method::create(["access_menu_id" => 2, "sub_menu_id" => 9, "edit" => "true", "delete" => "true", "view" => "true"]);
        Method::create(["access_menu_id" => 2, "sub_menu_id" => 10, "edit" => "true", "delete" => "true", "view" => "true"]);
        Method::create(["access_menu_id" => 2, "sub_menu_id" => 11, "edit" => "true", "delete" => "true", "view" => "true"]);

           



    }
}
