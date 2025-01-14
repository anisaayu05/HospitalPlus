<template>
  <!-- Hero Section -->
  <section id="home" class="hero-section bg-white text-white py-5">
    <div
      class="container d-flex align-items-center"
      style="width: 80%; max-width: 1400px; height: 80%; padding: 3%"
    >
      <!-- Content on the left -->
      <div class="hero-content mr-5">
        <h1 style="font-size: 350%">Efficient Hospital Information System</h1>
        <p style="font-size: 150%">
          Optimizing hospital management with automated scheduling, patient data
          management, and department coordination tools.
        </p>
        <a href="#features" class="btn btn-light" style="font-size: 130%"
          >Explore Features</a
        >
      </div>
      <!-- Image on the right -->
      <div class="hero-image">
        <img src="../assets/img/doctor.png" alt="Doctor" class="img-fluid" />
      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section id="features" class="py-5">
    <div
      class="container text-center"
      style="width: 80%; max-width: 1400px; height: 80%; padding: 3%"
    >
      <h2 style="padding-top: 1px; padding-bottom: 25px">
        Our Hospital Services
      </h2>
      <div class="row">
        <div class="col-md-4" v-for="(feature, index) in features" :key="index">
          <a :href="feature.link" class="text-decoration-none">
            <div class="feature-card p-4 d-flex flex-column h-100">
              <i :class="feature.icon + ' fa-3x mb-3'"></i>
              <h3>{{ feature.title }}</h3>
              <p>{{ feature.description }}</p>
            </div>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Hospital Management Section -->
  <section id="hospital-management" class="py-5">
    <div
      class="container text-center"
      style="width: 80%; max-width: 1400px; height: 80%; padding: 3%"
    >
      <h2 style="padding-top: 1px; padding-bottom: 25px">
        Hospital Management
      </h2>
      <div class="row">
        <div
          class="col-md-4"
          v-for="(management, index) in hospitalManagement"
          :key="index"
        >
          <a :href="management.link" class="text-decoration-none">
            <div class="feature-card p-4 d-flex flex-column h-100">
              <i :class="management.icon + ' fa-3x mb-3'"></i>
              <h3>{{ management.title }}</h3>
              <p>{{ management.description }}</p>
            </div>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- <section id="financial-management" class="py-5">
    <div class="container text-center">
      <h2>Financial Management</h2>
      <div class="row">
        <div class="col-md-6" v-for="(financial, index) in financialManagement" :key="index">
          <a :href="financial.link" class="text-decoration-none">
            <div class="feature-card p-4">
              <i :class="financial.icon + ' fa-3x mb-3'"></i>
              <h3>{{ financial.title }}</h3>
              <p>{{ financial.description }}</p>
            </div>
          </a>
        </div>
      </div>
    </div>
  </section> -->

  <!-- Departments Section -->
  <!-- Our Hospital Departments Section -->
  <section id="departments" class="py-5">
    <div
      class="container text-center"
      style="width: 80%; max-width: 1400px; height: 80%; padding: 3%"
    >
      <h2 style="padding-top: 1px; padding-bottom: 25px">
        Our Hospital Departments
      </h2>
      <div class="row">
        <div
          class="col-md-3"
          v-for="(department, index) in departments"
          :key="index"
        >
          <a :href="department.link" class="text-decoration-none">
            <div class="department-card p-4 d-flex flex-column h-100">
              <h3>{{ department.title }}</h3>
              <p>{{ department.description }}</p>
            </div>
          </a>
        </div>
      </div>
    </div>
  </section>

<!-- Footer -->
<footer id="contact" style="background-color: black; color: #D1D5DB; padding: 3rem 0;">
    <div style="display: flex; flex-wrap: wrap; padding: 0 2rem;">
        <!-- Column 1: Logo & Description -->
        <div style="width: 100%; flex: 0 0 33.333333%; padding-right: 3rem; display: flex; flex-direction: column; align-items: center; text-align: center;">
            <h2 style="color: white; font-size: 1.5rem; font-weight: 700;">HospitalPlus</h2>
            <p style="color: #9CA3AF; margin-top: 1rem;">
                Advanced solutions for efficient hospital management. Focused on improving healthcare services through technology.
            </p>
            <div style="display: flex; gap: 1.5rem; margin-top: 1.5rem;">
                <a href="#" style="color: #9CA3AF;">
                    <i class="fab fa-facebook-f" style="font-size: 1.25rem;"></i>
                </a>
                <a href="#" style="color: #9CA3AF;">
                    <i class="fab fa-instagram" style="font-size: 1.25rem;"></i>
                </a>
                <a href="#" style="color: #9CA3AF;">
                    <i class="fab fa-twitter" style="font-size: 1.25rem;"></i>
                </a>
                <a href="#" style="color: #9CA3AF;">
                    <i class="fab fa-linkedin-in" style="font-size: 1.25rem;"></i>
                </a>
            </div>
        </div>

        <!-- Column 2: Features -->
        <div style="width: 100%; flex: 0 0 33.333333%; padding: 0 3rem; display: flex; flex-direction: column; align-items: center; text-align: center;">
            <h5 style="color: white; font-size: 1.125rem; font-weight: 600;">Features</h5>
            <ul style="margin-top: 1rem; list-style: none; padding: 0;">
                <li style="margin: 0.5rem 0;">
                    <a href="/appointments" style="color: #9CA3AF; text-decoration: none;">
                        Appointment Scheduling
                    </a>
                </li>
                <li style="margin: 0.5rem 0;">
                    <a href="/patients" style="color: #9CA3AF; text-decoration: none;">
                        Patient Management
                    </a>
                </li>
                <li style="margin: 0.5rem 0;">
                    <a href="/ehr" style="color: #9CA3AF; text-decoration: none;">
                        Electronic Health Records (EHR)
                    </a>
                </li>
            </ul>
        </div>

        <!-- Column 3: Contact -->
        <div style="width: 100%; flex: 0 0 33.333333%; padding-left: 3rem; display: flex; flex-direction: column; align-items: center;">
            <h5 style="color: white; font-size: 1.125rem; font-weight: 600;">Contact Us</h5>
            <div style="margin-top: 1rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem; margin: 0.5rem 0;">
                    <i class="fas fa-phone-alt" style="color: #9CA3AF;"></i>
                    <a href="tel:(123)555-4567" style="color: #9CA3AF; text-decoration: none;">
                        (123) 555-4567
                    </a>
                </div>
                <div style="display: flex; align-items: center; gap: 0.75rem; margin: 0.5rem 0;">
                    <i class="fas fa-map-marker-alt" style="color: #9CA3AF;"></i>
                    <a href="#" style="color: #9CA3AF; text-decoration: none;">
                        Jl. Sehat No.12, Kota Bahagia
                    </a>
                </div>
                <div style="display: flex; align-items: center; gap: 0.75rem; margin: 0.5rem 0;">
                    <i class="fas fa-envelope" style="color: #9CA3AF;"></i>
                    <a href="mailto:hospitalplus@gmail.com" style="color: #9CA3AF; text-decoration: none;">
                        hospitalplus@gmail.com
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid #1F2937;">
        <div style="padding: 0 2rem; display: flex; align-items: center; justify-content: space-between;">
            <p style="color: #9CA3AF; font-size: 0.875rem;">
                &copy; 2024 HospitalPlus | All Rights Reserved
            </p>
            <a href="#" style="color: #9CA3AF; font-size: 0.875rem; text-decoration: none;">Privacy Policy</a>
        </div>
    </div>
</footer>

</template>

<script>
export default {
  data() {
    return {
      features: [
        {
          title: "Appointment Scheduling",
          description:
            "Efficient management of patient appointments and doctor schedules.",
          icon: "fas fa-calendar-check",
          link: "/appointments",
        },
        {
          title: "Patient Management",
          description:
            "Centralized patient records, medical histories, and real-time data access for healthcare providers.",
          icon: "fas fa-user-md",
          link: "patients",
        },
        {
          title: "Electronic Health Records (EHR)",
          description:
            "Manage patient health data digitally for quicker access and improved care coordination.",
          icon: "fas fa-procedures",
          link: "/ehr",
        },
      ],
      hospitalManagement: [
        {
          title: "Doctors Management",
          description:
            "Streamline hospital operations including bed management, facility booking, and resource allocation.",
          icon: "fas fa-hospital",
          link: "/doctors",
        },
        {
          title: "Room Allocation",
          description:
            "Real-time room allocation and patient bed management with automated notifications.",
          icon: "fas fa-bed",
          link: "/rooms",
        },
        {
          title: "Medical Records",
          description:
            "Complete medical record management for all patients with quick search and update options.",
          icon: "fas fa-file-medical-alt",
          link: "/medical-records",
        },
      ],
      financialManagement: [
        {
          title: "Billing & Payment",
          description:
            "Manage patient billing, payments, and insurance claims easily.",
          icon: "fas fa-dollar-sign",
          link: "billing-payment.html",
        },
        {
          title: "Financial Reporting",
          description:
            "Generate detailed financial reports for hospital performance and budget management.",
          icon: "fas fa-chart-line",
          link: "financial-reporting.html",
        },
      ],
      departments: [
        {
          title: "Emergency",
          description:
            "24/7 emergency services equipped with the latest medical technologies.",
        //   link: "emergency.html",
        },
        {
          title: "Cardiology",
          description:
            "Comprehensive cardiovascular care and diagnostic services.",
        //   link: "cardiology.html",
        },
        {
          title: "Pediatrics",
          description:
            "Expert care for children with personalized treatment plans.",
        //   link: "pediatrics.html",
        },
        {
          title: "Radiology",
          description:
            "Advanced diagnostic imaging and radiology services for precise results.",
        //   link: "radiology.html",
        },
      ],
    };
  },
};
</script>

<style scoped>
/* General Body and Typography */
body {
  font-family: "Poppins", sans-serif;
  margin: 0;
  padding: 0;
  background-color: #121212;
  background-size: cover;
  color: #eaeaea;
}

h1,
h2,
h3 {
  font-weight: 600;
  color: #f0f0f0;
}

p {
  font-weight: 300;
  color: #b0b0b0;
}

/* Hero Section */
.hero-section {
  background: linear-gradient(135deg, #1f1f1f, #1f1f1f);
  max-width: 150%;
  color: white;
  padding: 20px 0;
  display: flex;
  align-items: center;
  justify-content: space-between;
  text-align: left;
}

.hero-content {
  max-width: 50%;
}

.hero-content h1 {
  font-size: 2.5rem;
  line-height: 1.3;
}

.hero-content p {
  font-size: 1.1rem;
  line-height: 1.6;
  margin-bottom: 20px;
}

.hero-image {
  flex: 1;
  display: flex;
  justify-content: flex-end;
}

.hero-image img {
  max-width: 80%;
  height: auto;
  border-radius: 10px;
}

.hero-section .btn {
  font-size: 1rem;
  padding: 10px 30px;
  background-color: #00a8cc;
  color: white;
  border: none;
  font-weight: 600;
  border-radius: 5px;
  transition: background-color 0.3s ease, transform 0.3s ease;
}

.hero-section .btn:hover {
  background-color: #007bff;
  transform: scale(1.05);
}

/* Section Backgrounds */
section {
  background-color: #1f1f1f;
  padding: 60px 0;
  background-size: 100%;
}

section:nth-child(even) {
  background-color: #1f1f1f;
}

/* Features and Card Styling */
.feature-card {
  background-color: #222831;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
  border-radius: 10px;
  text-align: center;
  padding: 20px;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  color: #eaeaea;
}

.feature-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
}

.feature-card i {
  color: #00a8cc;
  font-size: 3rem;
  margin-bottom: 15px;
  transition: transform 0.3s ease;
}

.feature-card:hover i {
  transform: scale(1.2);
}

.feature-card h3 {
  font-size: 1.25rem;
  margin-top: 15px;
  color: #f0f0f0;
}

.feature-card p {
  font-size: 1rem;
  color: #b0b0b0;
}

/* Departments Section */
.department-card {
  background-color: #222831;
  padding: 20px;
  text-align: center;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
  border-radius: 10px;
  color: #eaeaea;
}

.department-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
}

.department-card h3 {
  font-size: 1.25rem;
  margin-top: 15px;
  color: #f0f0f0;
}

.department-card p {
  font-size: 1rem;
  color: #b0b0b0;
}

/* 
#contact-form input,
#contact-form textarea {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #555;
  border-radius: 5px;
  font-size: 1rem;
  background-color: #1a1a2e;
  color: #eaeaea;
}

#contact-form input::placeholder,
#contact-form textarea::placeholder {
  color: #888;
}

#contact-form button {
  width: 100%;
  padding: 12px;
  background-color: #00a8cc;
  color: white;
  font-size: 1.1rem;
  border: none;
  border-radius: 5px;
  transition: background-color 0.3s ease, transform 0.3s ease;
}

#contact-form button:hover {
  background-color: #007bff;
  transform: scale(1.05);
}


footer {
  background-color: #1a252f;
  color: white;
  padding: 30px 0;
}

.footer-logo {
  font-size: 24px;
  font-weight: bold;
}

footer a {
  color: #d1ddf1;
  transition: color 0.3s ease;
}

footer a:hover {
  color: #03acf2;
}

footer hr {
  border-top: 1px solid #555;
  margin: 20px 0;
}

footer .list-unstyled li {
  margin-bottom: 10px;
}

footer .list-unstyled a {
  font-size: 14px;
}

footer .d-flex a {
  font-size: 18px;
} */

/* Responsiveness */
@media (max-width: 768px) {
  footer .row {
    text-align: center;
  }

  footer .d-flex {
    justify-content: center;
  }
}
</style>
