<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">


      <div v-if="userRole==='admin'">

<a class="navbar-brand" id="navlink" href="/">
        <img src="../assets/building-svgrepo-com.svg" alt="Logo" width="30" height="34"
          class="d-inline-block align-text-top"> &nbsp;
        <span class="navbar-brand mb-0 h1">BuildingMS</span>
      </a>

      </div>

      <div v-else-if="userRole==='user'">

<a class="navbar-brand" id="navlink" href="/">
        <img src="../assets/svg/home-page-svgrepo-com.svg" alt="Logo" width="30" height="34"
          class="d-inline-block align-text-top"> &nbsp;
        <span class="navbar-brand mb-0 h1">HomeStay</span>
      </a>

      </div>    

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <router-link to="/" class="nav-link active">Home</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/browserooms" class="nav-link active">Browse Rooms</router-link>
          </li>
          <li class="nav-item" v-if="!isLoggedIn">
            <router-link to="/register" class="nav-link active">Register</router-link>
          </li>
          <li class="nav-item" v-if="!isLoggedIn">
            <router-link to="/login" class="nav-link active">Login</router-link>
          </li>
          <li class="nav-item" v-if="isLoggedIn && userRole === 'user'">
            <router-link to="/rented-rooms" class="nav-link active">View Rented Rooms</router-link>
          </li>
          <li class="nav-item" v-if="isLoggedIn && userRole === 'user'">
            <router-link to="/history" class="nav-link active">View History</router-link>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item" v-if="isLoggedIn">
            <button @click="logout" class="btn btn-danger my-2 my-sm-0">Logout</button>
          </li>
          <li class="nav-item" v-if="isLoggedIn">
            <router-link to="/Profile" class="nav-link">
              <img src="../assets/svg/profile.svg" alt="Profile" width="30" height="26" />
            </router-link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: 'NavBar',
  data() {
    return {
      user: null // Store user details
    };
  },
  methods: {
    logout() {
      // Confirm logout
      if (confirm('Are you sure you want to log out?')) {
        localStorage.removeItem('token');
        localStorage.removeItem('role');
        localStorage.removeItem('user');
        this.updateAuthState(); // Update the authentication state after logout
        this.$router.push('/login');
      }
    },
    updateAuthState() {
      this.user = JSON.parse(localStorage.getItem('user'));
      this.$emit('authChanged', this.isLoggedIn); // Emit an event to notify parent components
    },
  },
  computed: {
    isLoggedIn() {
      return !!localStorage.getItem('token'); // Check if token exists
    },
    userName() {
      // Retrieve the user details from local storage
      const user = JSON.parse(localStorage.getItem('user'));
      return user ? `${user.firstname} ${user.lastname}` : ''; // Return full name or empty string
    },
    userRole() {
      return localStorage.getItem('role'); // Get role from local storage
    }
  },
  created() {
    // Check if user data is available and store it in component's state
    this.updateAuthState();
  }
};
</script>

<style scoped>
.navbar {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 70px;
  padding: 10px;
  background-color: #333; /* Example background */
  z-index: 1000; /* Ensures it's above other content */
}

.nav-link {
  color: white; /* Link color */
}

.user-welcome {
  color: #007bff;
  font-size: 19px;
  font-weight: bold;
}

/* Adjustments to position the logout button and profile icon */
.navbar-nav:last-child {
  display: flex;
  align-items: center; /* Vertically center items */
}

.nav-item {
  margin-left: 20px; /* Space between logout and profile */
}
</style>
