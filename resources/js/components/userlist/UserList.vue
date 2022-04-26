<template>
    <div class="container">
       <el-card class="box-card">
            <div slot="header" class="clearfix">          
                User Data                         
            </div>
        
             <el-row :gutter="20" style="margin-bottom:20px;">
                    <el-col :span="12">
                        <div class="grid-content bg-purple">
                            <el-input v-model="search" placeholder="Type Search here" />
                        </div>
                    </el-col>
                    <el-col :span="12">
                        <div class="grid-content bg-purple"> 
                            <a href="/add-user">
                                <el-button type="success" class="float-right" >Add user
                                </el-button>
                            </a>
                        </div>
                    </el-col>
                </el-row>
            <div>

             <el-table
                :data="tableData"
                style="width: 100%"
                :border="true"
                height="500">
                <el-table-column v-for="column in tableColumns"
                    :key="column.label"
                    :label="column.label"
                    :prop="column.prop"
                    :column-key="column.prop"
                    :min-width="column.minWidth"
                    :sortable="column.sortable"
                    :align="column.align"
                    :header-align="column.align">
                </el-table-column>

                <el-table-column align=right>                  

                    <template slot-scope="scope">
                        <el-button size="mini" type="success"  @click="editUser(scope.$index, scope.row)">
                            Edit                         
                        </el-button>
                        <el-button size="mini" type="danger" @click="deleteUser(scope.$index, scope.row)">Delete</el-button>
                    </template>
                </el-table-column>
            </el-table>
                
            </div>
        </el-card>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    export default {
        name: 'user-form',
        props:{
            scope:String,
            id:Number,
        },
        mounted(){
            const loading = this.$loading({
                lock: true,
                text: 'loading...',
                spinner: 'el-icon-loading',
                background: 'rgba(255,255,255,0.85)',
            });

            this.$store.dispatch('getUsersData', {searchQuery: this.search});

            loading.close();
        },
        watch:{
            search: function(keyword){
                this.$store.dispatch('getUsersData', {searchQuery: this.search});
            }
        },
        computed:{
            ...mapGetters({
                tableData:"tableData"
            })
        },
        data(){
            return{
                search:null,
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
                },
                tableColumns:[
                    {
                        prop:'first_name',
                        label: 'First Name',
                        minWidth:100,
                        sortable:true,
                        hidden:true,
                        align:"center",
                        fixed:true,
                    },
                    {
                        prop:'family_name',
                        label: 'Family Name',
                        minWidth:100,
                        sortable:false,
                        hidden:true,
                        align:"center",
                        fixed:true,
                    },
                    {
                        prop:'email',
                        label: 'Email',
                        minWidth:100,
                        sortable:false,
                        hidden:true,
                        align:"center",
                        fixed:true,
                    },
                    {
                        prop:'user_name',
                        label: 'User name',
                        minWidth:100,
                        sortable:false,
                        hidden:true,
                        align:"center",
                        fixed:true,
                    },
                    {
                        prop:'gender',
                        label: 'gender',
                        minWidth:100,
                        sortable:false,
                        hidden:true,
                        align:"center",
                        fixed:true,
                    },
                    {
                        prop:'phone_number',
                        label: 'Phone Number',
                        minWidth:100,
                        sortable:false,
                        hidden:true,
                        align:"center",
                        fixed:true,
                    },
                     {
                        prop:'role',
                        label: 'Role',
                        minWidth:100,
                        sortable:false,
                        hidden:true,
                        align:"center",
                        fixed:true,
                    }
                ]
            }
        },
        methods:{
            editUser(index, row){
                window.location.href="/edit-user/"+row.id+'/edit';
            },
            deleteUser(index, row){
                this.$confirm('Are you sure, You want to delete this user', 'Warning', {
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Cancel',
                    type: 'warning'
                }).then(() => {console.log(row.id+'ok');

                    this.$store.dispatch('deleteUser', {
                        id: row.id
                    });
                    
                    this.$store.dispatch('getUsersData', {searchQuery: this.search});

                    this.$message({
                        type: 'success',
                        message: 'Delete completed'
                    });
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: 'Delete canceled'
                    });          
                });
            }
        }
    }
</script>

<style scoped>
    .float-right{
        float: right;
    }
</style>
