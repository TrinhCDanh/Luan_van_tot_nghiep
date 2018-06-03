<template id="lop-add">
    <div class="row">
        <v-form v-model="valid" v-on:submit.prevent="createItem" methods="POST">
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
                ]
            };
        },
        created() {

        },
        methods: {
            createItem: function () {
                let url = location.origin + '/api/lop';
                axios.post(url,this.lop).then((rep) =>{
                    alert('thanh cong');
                    this.$router.push({name: 'LopList'})
                });
            }
        },
        computed: {},
        mounted(){

        }
    }
</script>