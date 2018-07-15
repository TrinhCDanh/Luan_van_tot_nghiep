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

                            <v-alert :value="error" type="error" v-if="error != ''">
                                {{ error }}
                            </v-alert>
                            <br>

                            <v-text-field v-model="phongmay.tenphongmay" :rules="nameRules" label="Tên phòng máy"
                                           disabled></v-text-field>
                            <v-text-field mask="##" v-model="phongmay.soluongmay" :rules="soluongRules"
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
                error: '',
                nameRules: [
                    v => !!v || 'Bạn chưa nhập tên phòng máy',
                    v => v.length <= 10 || 'Name must be less than 4 characters'
                ],
                soluongRules: [
                    v => !!v || 'Bạn chưa nhập số lượng máy',
                    v => !Number.isNaN(v) || 'Name must be less than 10 characters'
                ],
                phongmayList: [],
            }
        },
        created: function () {
            var _this = this;
            let url = location.origin + '/api/phongmay';
            axios.get(url).then((rep) => {
                this.phongmayList = rep.data;
            })
            setTimeout(function () {
                console.log(_this.phongmay.tenphongmay);
                if (_this.phongmayList.length == 0) {
                    _this.phongmay.tenphongmay = 'PM01';
                } else {
                    var lastIndex = _this.phongmayList.length - 1;
                    var somayCurrent = parseInt(_this.phongmayList[lastIndex].tenphongmay.replace('PM', ''));
                    var somayNext = somayCurrent + 1;
                    var phongmayNext = 'PM'+ ('0' + somayNext).slice(-2);
                    _this.phongmay.tenphongmay = phongmayNext;
                }
            }, 500)
        },
        methods: {
            createphongmay: function () {
                var _this = this;
                let url = location.origin + '/api/phongmay';
                axios.post(url, _this.phongmay).then((rep) => {
                    if (rep.data.error) {
                        _this.error = rep.data.error;
                    } else {
                        _this.$router.push({name: 'PhongmayList'})
                    }
                })
                // if (this.phongmayList.length == 0) {
                //
                // } else {
                //     var lastIndex = this.phongmayList.length - 1;
                //     var somayCurrent = parseInt(this.phongmayList[lastIndex].tenphongmay.replace('PM', ''));
                //     var somayNext = somayCurrent + 1;
                //     var mayNext = 'PM' + somayNext;
                //     this.phongmay.tenphongmay = mayNext;
                // }

                // if(this.maylist.length == 0) {
                //     var tenphongmayArr = this.phongmay.tenphongmay.split("M");
                //     var sothutumayNext = "P" + tenphongmayArr[1] + "_" + "01" ;
                //     var slugNext = "p" + tenphongmayArr[1] + "-" + "01" ;
                // } else {
                //     var lastIndex = this.maylist.length - 1;
                //     var sothutumayPrev = this.maylist[lastIndex].sothutumay;
                //     console.log(sothutumayPrev);
                //
                //     var sothutumayNextArr = sothutumayPrev.split("_");
                //     //sothutumayPrev.slice(sothutumayPrev.lastIndexOf('_') + 1 , sothutumayPrev.length);
                //     var test = parseInt(sothutumayNextArr[1]) + 1;
                //
                //     var sothutumayNext = sothutumayNextArr[0] + "_" + ('0' + test).slice(-2) ;
                //
                //     var slugNext = sothutumayNextArr[0].toLowerCase() + "-" + ('0' + test).slice(-2);
                // }


            }
        }
    }
</script>