<template id="add-phongmay">
    <div>

        <v-layout justify-center>
            <v-flex xs12 sm10 md8 lg6>
                <v-card ref="form">
                    <v-card-title>
                        <p class="display-1">Thêm thông tin phòng máy</p>
                    </v-card-title>
                    <v-form v-model="valid" v-on:submit.prevent="createphongmay" method="POST">
                        <v-card-text>

                            <v-text-field v-model="phongmay.tenphongmay" :rules="nameRules" label="Tên phòng máy"
                                          required></v-text-field>
                            <v-text-field type="number" v-model="phongmay.soluongmay" :rules="soluongRules"
                                          label="Số lượng máy trong phòng" required></v-text-field>

                        </v-card-text>
                        <v-divider class="mt-5"></v-divider>
                        <v-card-actions>
                            <v-btn v-bind:to="{name: 'PhongmayList'}">Back</v-btn>
                            <v-spacer></v-spacer>
                            <v-btn type="submit" class="btn btn-xs btn-primary" color="success">Save</v-btn>
                        </v-card-actions>
                    </v-form>
                </v-card>
            </v-flex>
        </v-layout>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                phongmay: {tenphongmay: '', soluongmay: ''},
                valid: false,
                name: '',
                nameRules: [
                    v => !!v || 'Bạn chưa nhập tên phòng máy',
                    v => v.length <= 10 || 'Name must be less than 4 characters'
                ],
                soluongRules: [
                    v => !!v || 'Bạn chưa nhập số lượng máy',
                    v => !Number.isNaN(v) || 'Name must be less than 10 characters'
                ]
            }
        },
        methods: {

            createphongmay: function () {
                let url = location.origin + '/api/phongmay';
                axios.post(url, this.phongmay).then((rep) => {
                    this.$router.push({name: 'PhongmayList'})
                })
            }
            // createphongmay: function() {
            //   let uri = location.origin + '/api/phongmay';
            //   Axios.post(uri, this.phongmay).then((response) => {
            //      this.$router.push({name: 'PhongmayList'})
            //   })
            // }
        }
    }
</script>