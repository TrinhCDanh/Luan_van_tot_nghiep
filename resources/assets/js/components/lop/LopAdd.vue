<template id="lop-add">
    <div class="row">
        <v-form v-model="valid" v-on:submit.prevent="createItem" methods="POST">
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
                    mask="####"
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

        },
        methods: {
            createItem: function () {
                let url = location.origin + '/api/lop';
                var siso = this.lop.siso;
                var tenlop = this.lop.tenlop;
                if(siso != '' && tenlop !=''){
                    axios.post(url,this.lop).then((rep) =>{
                        this.$router.push({name: 'LopList'})
                    });
                }else{
                    this.error = 'Vui lòng kiểm tra lại thông tin'
                }

            }
        },
        computed: {},
        mounted(){

        }
    }
</script>