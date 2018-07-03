<template id="lop-edit">
    <div class="row">
        <v-form v-model="valid" v-on:submit.prevent="editItem" methods="POST">
            <v-card-title v-if="error != ''">
                <p class="display-1" >{{ error }}</p>
            </v-card-title>
            <v-text-field
                    v-model="lop.tenlop"
                    :rules="tenlRules"
                    label="Tên Lớp"
                    required
            ></v-text-field>
            <v-text-field
                    v-model="lop.siso"
                    :rules="sisolRules"
                    label="Sỉ Số"
                    required
            ></v-text-field>
            <v-btn v-bind:to="{name: 'LopList'}">Back</v-btn>
            <v-btn type="submit" class="btn btn-xs btn-primary" color="success">Save</v-btn>
        </v-form>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                valid: false,
                lop: {tenlop: '', siso: ''},
                sisolRules: [
                    v => !!v || 'Sỉ số không để trống',
                ],
                tenlRules: [
                    v => !!v || 'Tên lớp không để trống',
                ],
                error:'',
            };
        },
        created() {
            let urlCurrent = window.location.href;
            let id_lop = urlCurrent.slice(urlCurrent.lastIndexOf('/edit') + 5);
            let url = location.origin + '/api/lop' + id_lop + '/edit';
            axios.get(url).then((rep) => {
                this.lop = rep.data;
            });
        },
        methods: {
            editItem: function () {
                let url = window.location.origin + '/api/lop/' + this.lop.id;
                var siso = this.lop.siso;
                var tenlop = this.lop.tenlop;
                if(siso != '' && tenlop !=''){
                    axios.patch(url, this.lop).then((rep) => {
                        this.error = '';
                        alert('Sửa thành công');
                        this.$router.push({name: 'LopList'})
                    });
                }else{
                    this.error = 'Vui lòng kiểm tra lại thông tin'
                }
            }
        },
        computed: {}
    }
</script>