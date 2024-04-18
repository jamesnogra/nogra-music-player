<template>
    <div class="register-container">
        <h1 class="mb-3">Login as User</h1>
        <form @submit.prevent="submitForm" class="needs-validation" novalidate>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" class="form-control" v-model="formData.username" required>
            </div>
            <div class="form-group mb">
                <label for="password">Password:</label>
                <input type="password" id="password" class="form-control" v-model="formData.password" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: 'Register',
    data() {
        return {
            formData: {
                username: '',
                password: ''
            }
        }
    },
    methods: {
        submitForm() {
            if (this.formData.username.length === 0) {
                alert('Enter a valid username')
            }
            if (this.formData.password.length === 0) {
                alert('Enter a valid password')
            }
            // Make an HTTP POST request to login
            axios.post('/login', this.formData)
                .then(response => {
                    window.location = '/song'
                })
                .catch(error => {
                    alert(error.response.data.message)
                })
        }
    }
}
</script>

<style scoped>
.register-container {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    height: 100vh;
}

.needs-validation {
    width: 50%;
}

@media only screen and (max-width: 768px) {
    .needs-validation {
        width: 75%;
    }
}
</style>