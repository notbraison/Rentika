<template>
  <div class="loginform">
    <form @submit.prevent="login" id="loginform">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" /> 
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">User Login</h5>
          <br>
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" placeholder="name@example.com" v-model="email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input :type="passwordFieldType" class="form-control" id="password" placeholder="password" v-model="password"
              required>
              <br> 
              <div class="btn">
                <button  @click="switchVisibility" class="btn btn-light"
              style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" >show / hide</button>
              </div>
              
          </div>
          <div class="mb-3 d-flex align-items-center">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" v-model="rememberMe" id="rememberMe">
              <label class="form-check-label ms-2" for="rememberMe">
                Remember me
              </label>
            </div>
          </div>
          <div class="btn-container">
            <button type="submit" class="btn btn-outline-success">Login</button>
            <button type="reset" class="btn btn-outline-warning">Reset</button>
          </div>
          &nbsp;
          <div class="login-register-section">
            <p>Don't have an account?</p>
            <a href="/register" class="register-link">Create an account</a>
          </div>
        </div>
        <p class="link"><router-link to="/forgotPassword">Forgot Password ?</router-link></p>
      </div>
    </form>
  </div>
</template>

<script>

import axios from 'axios';
import {ref} from 'vue';

export default {
  name: 'UserLogin',
  data() {
    return {
      email: ref(''),
      password: '',
      response: null,
      token: null,
      rememberMe: false,
      passwordFieldType: "password"
    };
  },
  methods: {
    switchVisibility() {
      this.passwordFieldType = this.passwordFieldType === "password" ? "text" : "password";
    },
    async login() {
  try {
    await axios.get('/sanctum/csrf-cookie'); // Ensure CSRF token is set

    const response = await axios.post('http://127.0.0.1:8000/api/login', {
      email: this.email,
      password: this.password,
      remember_me: this.rememberMe
    });

    // Process login response
    this.token = response.data.token;
    this.role = response.data.role;
    this.user = response.data.user;

    if (this.token) {
      localStorage.setItem('token', this.token || '');
      localStorage.setItem('role', this.role || '');
      localStorage.setItem('user', JSON.stringify(this.user) || '{}');
      localStorage.setItem('userId', this.user?.user_id || '');

      this.$router.push('/');
    }
  } catch (error) {
    console.error(error);
    alert('Login failed. Please check your credentials.');
  }
}


},
    async fetchData() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/data', {
          headers: {
            Authorization: `Bearer ${this.$store.state.token}`,
          },
        });
      } catch (error) {
        console.error(error);
      }
    },
    async logcheck() {
      // Implement log check logic here
    }
  };
</script>

<style scoped>
* {
  background-color: white;
}

.btn-container {
  padding: 10px;
}

h5 {
  text-align: center;
}

.card {
  display: flex;
  justify-content: center;
  align-items: center;
  width: auto;
  height: auto;
}

.form-control {
  width: 450px;
}

.link {
  text-decoration: underline;
  font-weight: 800;
}
.login-register-section p{
  color:black
}
.login-register-section a{
  color:red
}

.btnOutline{
  margin:1px;
  color:black;
}
</style>
