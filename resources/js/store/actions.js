import Vue from 'vue';

let loader = null;

function displayLoader(loadingText="Loading...") {
    loader = Vue.prototype.$loading({
        lock: true,
        text: loadingText,
        spinner: 'el-icon-loading',
        background: 'rgba(255,255,255,0.85)',
    });
}

function removeLoader() {
    loader.close();
}

export const saveuser = ({ commit }, payload) => {

    displayLoader();

    axios.post(`/save-user`, payload).then(res => {
        Vue.prototype.$notify({
            title:'Success',
            message:'User added successfully',
            type:'success',
        })
        
        removeLoader();

        setTimeout(() => {
            window.location.href = '/userlists'
        }, 2000);
    })
}

export const getUsersData = ({ commit }, payload) =>{
    axios.post(`/get-user-data`, payload)
        .then(response => {
            commit('setTableData', response.data);
        })
}


export const updateUser = ({ commit }, payload) => {

    displayLoader('Update user');

    axios.put(`/update-user/${payload.id}`, payload.form).then(res => {
        Vue.prototype.$notify({
            title:'Success',
            message:'User updated successfully',
            type:'success',
        })
        
        removeLoader();

        setTimeout(() => {
            window.location.href = '/userlists'
        }, 2000);
    })
}

export const deleteUser = ({ commit }, payload) => {

    displayLoader('Deleting user');

    axios.delete(`/delete-user/${payload.id}`).then(res => {
        Vue.prototype.$notify({
            title: 'Success',
            message: res.data.message,
            type: 'success',
        })
        
        removeLoader();
      
    })
}
