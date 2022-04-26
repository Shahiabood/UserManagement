<template>
    <div class="container">
       <el-card class="box-card">
            <div slot="header" class="clearfix">
               <el-page-header @back="goBack" :content="`${scope} form`">
                </el-page-header>
            </div>
            <div>
                <el-form ref="userForm" :model="form">
                    <el-row :guuter="10">
                        <el-form-item
                            label="First Name" required prop="first_name">
                            <el-input v-model="form.first_name" 
                            aria-placeholder="Fisrt Name"></el-input>
                        </el-form-item>

                        <el-form-item
                            label="Family Name" required prop="family_name">
                            <el-input v-model="form.family_name" 
                            aria-placeholder="Family Name"></el-input>
                        </el-form-item>

                        <el-form-item
                            label="Email" required prop="email">
                            <el-input v-model="form.email" 
                            aria-placeholder="Email"></el-input>
                        </el-form-item>

                        <el-form-item
                            label="User Name" required prop="user_name">
                            <el-input v-model="form.user_name" 
                            aria-placeholder="User Name"></el-input>
                        </el-form-item>

                        <el-form-item
                            label="Date of Birth" required prop="dob">
                            <el-input v-model="form.dob" 
                            aria-placeholder="Date of Birth"></el-input>
                        </el-form-item>

                        <el-form-item
                            label="Gender" required prop="gender">
                            <el-input v-model="form.gender" 
                            aria-placeholder="Gender"></el-input>
                        </el-form-item>

                        <el-form-item
                            label="Password" required prop="password">
                            <el-input v-model="form.password" 
                            aria-placeholder="Password"></el-input>
                        </el-form-item>

                        <el-form-item
                            label="Phone Number" required prop="phone_number">
                            <el-input v-model="form.phone_number" 
                            aria-placeholder="Phone Number"></el-input>
                        </el-form-item>

                        <el-form-item
                            label="Role" required prop="role">
                            <el-input v-model="form.role" 
                            aria-placeholder="Role"></el-input>
                        </el-form-item>

                    </el-row>
                    <el-row :guuter="10">
                        <el-form-item>
                            <el-button type="success" @click="saveForm('userForm')">
                                save
                            </el-button>
                        </el-form-item>
                    </el-row>
                </el-form>
            </div>
        </el-card>
    </div>
</template>

<script>
    export default {
        name: 'user-form',
        props:{
            scope:String,
            id:Number,
        },
        mounted()
        {
            if(this.scope == 'edit')
            {
                axios.get(`/fetch-user-data/${this.id}`).then(res => {
                    this.$set(this, 'form', res.data.data);
                });
            }
        },
        data(){
            return{
                form:{
                    first_name:null,
                    family_name:null,
                    email:null,
                    user_name:null,
                    dob:null,
                    gender:null,
                    phone_number:null,
                    role:null,
                    password:null,
                }
            }
        },
        methods:{
            goBack(){
                window.location.href = '/userlists';
            },
            saveForm(formName){
                this.$refs[formName].validate((valid) => {
                    if(valid)
                    {
                        if(this.scope == 'create')
                        {
                            this.$store.dispatch('saveuser', this.form);
                        }
                        else
                        {
                            this.$store.dispatch('updateUser', 
                            {
                                id: this.id,
                                form: this.form,
                            });
                        }
                        
                    }
                })
            }
        }
    }
</script>
