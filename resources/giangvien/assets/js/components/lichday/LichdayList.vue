<template id="lichtruc-list">
  <div class="lichtruc-list-container" >

    <div style="position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);text-align: center">
      <v-progress-circular v-if="isLoading"  :size="70" :width="7" indeterminate color="blue">

      </v-progress-circular>
      <p class="error-text">{{ fetchError }}</p>
    </div>

    <v-card v-if="!isLoading" class="lichtruc-box">
    <v-card-title>
      <p class="display-1">Danh sách học kỳ</p>
      <v-spacer></v-spacer>
      <label style="margin-right: 10px; font-weight: bold">Phòng máy: </label>
      <select name="carlist" form="carform" class="slt-hocky" v-model="selectedPhongmay" v-on:change="choosePhongmay()" style="margin-right: 20px">
        <option
          v-for="( phongmay, key ) in phongmayList"
          :value="phongmay.id"
          :key="key"
        >
          {{ phongmay.tenphongmay }}
        </option>
      </select>
      
      <label style="margin-right: 10px; font-weight: bold">Học kỳ: </label>
      <select name="carlist" form="carform" class="slt-hocky" v-model="selectedHocky" v-on:change="chooseHocky()" style="margin-right: 20px">
        <option
          v-for="( hocky, key ) in hockyList"
          :value="hocky.id"
          :key="key"
        >
          {{ hocky.tenhocky }} - {{ hocky.namhoc }}
        </option>
      </select>

      <label style="margin-right: 10px; font-weight: bold">Tuần: </label>
      <select name="carlist" form="carform" class="slt-hocky" v-model="selectedTuanhoc" v-on:change="chooseHocky()">
        <option
          v-for="( tuanhoc, key ) in tuanhocList"
          :value="tuanhoc.tuanthu"
          :key="key"
        >
          {{ tuanhoc.tuanthu }} (từ {{ tuanhoc.ngaydautuanText }} - đến {{ tuanhoc.ngaycuoituanText }})
        </option>
      </select>

    </v-card-title>
    <div class="lichtruc-data">
      <div class="col-ca">
        <div class="ca-content" style="height: 50px">

        </div>
        <div class="ca-content" v-for="( ca, key ) in caList" :key="key">
          <p style="text-align: center; line-height: 100px; font-weight: bold">{{ ca.tenca }}</p>
        </div>
      </div>
      <div class="col-thu">
        <div class="row-thu">
          <div class="thu-content" v-for="( thu, key ) in thuList" :key="key"><p style="text-align: center; line-height: 50px; font-weight: bold">{{ thu.tenthu }}</p></div>
        </div>
        <div class="lichtruc-content">
          <div v-for="( thu, key ) in thuList" :key="key" style="width: 14.28%;">
            <div v-for="( ca, key ) in caList" :key="key">
              <div style="border: 1px solid white; height: 100px; background-color: #eeeeee">
                <div v-if=" checkLichtruc(ca.id, thu.id) == '' " class="lichtruc-detail">
                  <!-- {{ ca.tenca }} - {{ thu.tenthu }} -->
                    <!-- <v-btn v-on:click="addItem(ca.id, thu.id)">+</v-btn> -->
                    <!-- <v-btn icon class="mx-0 btn-add" @click="addItem(ca.id, thu.id)">
                      <v-icon color="blue">add</v-icon>
                    </v-btn> -->
                    <h3 style="line-height: 100px">N/A</h3> 
                </div>
                <!-- <div v-else-if=" checkLichtruc(ca.id, thu.id) == 'off' " class="lichtruc-detail">
                  <div v-if="checkLichdaybu(ca.id, thu.id) == '' ">
                    <h3 style="line-height: 100px">N/A</h3> 
                  </div>
                  <div v-else> BU </div>

                </div> -->
                <div v-else  class="lichtruc-detail">
                  <!-- <div v-if=" checkLichdaybu(ca.id, thu.id) != '' " >
                    {{ checkLichdaybu(ca.id, thu.id).tengiangvien }}
                  </div> -->
                  <div class="name-ktv" style="line-height: 100px">{{ checkLichtruc(ca.id, thu.id).tengiangvien }} {{ checkLichtruc(ca.id, thu.id).dangky_nghi_id ? '- Dạy bù' : ''}}</div>
                  <!-- <v-btn v-on:click="deleteItem(ca.id, thu.id)">x</v-btn>
                  <v-btn v-on:click="editItem(checkLichtruc(ca.id, thu.id).id)">e</v-btn> -->

                  <!-- <div class="btn-action">
                    <v-btn icon class="mx-0" @click="editItem(checkLichtruc(ca.id, thu.id).id)">
                      <v-icon color="teal">edit</v-icon>
                    </v-btn>
                    <v-btn icon class="mx-0" @click="deleteItem(ca.id, thu.id)">
                      <v-icon color="pink">delete</v-icon>
                    </v-btn>
                  </div> -->

                </div>

              </div>

            </div>
          </div>

        </div>

      </div>
    </div>
  </v-card>

  </div>

</template>

<script>
export default {
  data:function(){
    return {
      isLoading: false,
      countLoading: 0,
      fetchError: '',
      urlCurrent: location.origin,
      hockyList: [],
      caList: [],
      thuList: [],
      phongmayList: [],
      tuanhocList: [],
      dangkynghiList: [],
      dangkydaybuList: [],
      selectedHocky: 0,
      selectedPhongmay: 18,
      selectedTuanhoc: 't1',
      lichtrucList: [
        // { ca_id: 1, thu_id: 1, name: 'Kythuatvien Two' },
        // { ca_id: 5, thu_id: 1, name: 'Kythuatvien Five'},
        // { ca_id: 3, thu_id: 2, name: 'Kythuatvien Six'},
        // { ca_id: 1, thu_id: 2, name: 'Kythuatvien Six'},
        // { ca_id: 3, thu_id: 4, name: 'Kythuatvien Six'}
      ]
    };
  },
  created: function() {
    var _this = this;
    // let uri = location.origin+'/api/lichtruc';
    // Axios.get(uri).then((response) => {
    //   this.lichtruclist = response.data;
    //   console.log(this.lichtruclist);
    // });
    _this.fetchData();

    // var startDate = parseDate("01/12/2011").getTime();
    // var endDate = parseDate("04/12/2011").getTime();

    // if (startDate > endDate) {
    //   alert("Ngày bắt đầu lớn hơn");
    // } else {
    //   alert("Ngày kết thúc lớn hơn");
    // }

    // for(var item of this.lichtrucList) {
    //   console.log(item);
    // }

  },
  methods: {
    fetchData() {
      var _this = this;
      _this.isLoading = true;
      Axios.get(_this.urlCurrent+'/api/ca').then((response) => {
         _this.caList = response.data;
         _this.countLoading++;
      }).catch(function (error) {
        _this.fetchError = 'Xin lỗi, máy chủ gặp vấn đề! Vui lòng load lại trang';
      });

      Axios.get(_this.urlCurrent+'/api/thu').then((response) => {
         _this.thuList = response.data;
         _this.countLoading++;
         // console.log(_this.thuList);
      }).catch(function (error) {
        _this.fetchError = 'Xin lỗi, máy chủ gặp vấn đề! Vui lòng load lại trang';
      });

      
      Axios.get(_this.urlCurrent+'/api/phongmay').then((response) => {
        _this.phongmayList = response.data;
      });

      Axios.get(_this.urlCurrent+'/api/hocky').then((response) => {
        _this.hockyList = response.data;
        _this.countLoading++;
         // console.log(typeof _this.hockyList[0].ngaybatdau);
         // var utc = new Date().toJSON().slice(0,10).replace(/-/g,'-');
         // console.log(utc);
        //var utc = new Date().toJSON().slice(0,10).replace(/-/g,'-');
        // var ngayhientai = utc.getTime();
        // console.log(ngayhientai);
        var today = new Date();
        var date =  today.getFullYear()  + '-' + ('0' + (today.getMonth()+1)).slice(-2) + '-' + ('0' + today.getDate()).slice(-2);
        var ngayhientai = new Date(date).getTime();
        
        for(var hocky of this.hockyList) {
          var ngaybatdau = new Date(hocky.ngaybatdau).getTime();
          var ngayketthuc = new Date(hocky.ngayketthuc).getTime();
          if(ngaybatdau <= ngayhientai && ngayhientai <= ngayketthuc) {
            _this.selectedHocky = hocky.id;
            break;
          }
        }

        Axios.get(_this.urlCurrent+'/api/lichday-hocky-ca/' + _this.selectedHocky + "/" + _this.selectedPhongmay).then((response) => {
           _this.lichtrucList = response.data;
           //console.log(_this.lichtrucList);
           _this.countLoading++;
           if(_this.countLoading == 4) {
              setTimeout(() => {
                  _this.isLoading = false;
              }, 2000);
           }
        }).catch(function (error) {
          _this.fetchError = 'Xin lỗi, máy chủ gặp vấn đề! Vui lòng load lại trang';
        });

        Axios.get(_this.urlCurrent+'/api/hocky-tuanhoc/' + _this.selectedHocky).then((response) => {
          //  var result = response.data.substr(0, response.data.lastIndexOf(','));
          //   result = result + "]";
            _this.tuanhocList = response.data;
           //console.log(_this.tuanhocList);
           for(var tuanhoc of _this.tuanhocList) {
              var ngaydautuan = new Date(tuanhoc.ngaydautuan).getTime();
              var ngaycuoituan = new Date(tuanhoc.ngaycuoituan).getTime();
              if(ngaydautuan <= ngayhientai && ngayhientai <= ngaycuoituan) {
                _this.selectedTuanhoc = tuanhoc.tuanthu;
                break;
              }
            }
        });

        Axios.get(_this.urlCurrent+'/api/lich-nghi-ngay-nghi/'  + _this.selectedHocky).then((response) => {
          _this.dangkynghiList = response.data;
        });

        Axios.get(_this.urlCurrent+'/api/lich-bu-ngay-bu/'  + _this.selectedHocky).then((response) => {
          _this.dangkydaybuList = response.data;
        });

      }).catch(function (error) {
        _this.fetchError = 'Xin lỗi, máy chủ gặp vấn đề! Vui lòng load lại trang';
      });

      

    },
    chooseHocky() {
        var _this = this;
        Axios.get(_this.urlCurrent+'/api/lichday-hocky-ca/' + _this.selectedHocky + "/" + _this.selectedPhongmay).then((response) => {
            _this.lichtrucList = response.data;
        });
    },
    choosePhongmay() {
        var _this = this;
        Axios.get(_this.urlCurrent+'/api/lichday-hocky-ca/' + _this.selectedHocky + "/" + _this.selectedPhongmay).then((response) => {
            _this.lichtrucList = response.data;
        });
    },
    // chooseTuanhoc(tuanhoc) {
    //   var _this = this;
    //   _this.selectedTuanhoc = 
    // },
    addItem(ca_id, thu_id) {
      //alert(ca_id + ' - ' + thu_id);
      this.$router.push({
          name: 'LichtrucAdd',
          params: { hocky_id: this.selectedHocky, ca_id: ca_id, thu_id: thu_id }
      });
    },
    deleteItem(ca_id, thu_id) {
      var dem = 0;
      var result = '';
      for(var item of this.lichtrucList) {
        if(item.ca_id == ca_id && item.thu_id == thu_id)
          dem++;
        if(dem == 1) {
          Axios.delete(this.urlCurrent+'/api/lichtruc/'+item.id).then((response) => {
            const index = this.lichtrucList.indexOf(item);
            this.lichtrucList.splice(index, 1);
          });
          break;
        }
      }
    },
    editItem(lichtruc_id) {
      //console.log(lichtruc_id);
      this.$router.push({ path: `/admin/lichtruc/edit/${lichtruc_id}` });
    },
    checkLichtruc(ca_id, thu_id) {
      var _this = this;
      var dem = 0;
      var dembu = 0;
      var demnghi = 0;
      var result = '';

      for(var item of _this.dangkynghiList) {
        //var tuanhoc = JSON.parse(item.tuanhoc);
        if(item.ca_id == ca_id && item.thu_id == thu_id && item.tentuan == _this.selectedTuanhoc && item.phongmay_id == _this.selectedPhongmay)
          demnghi++;
        if(demnghi == 1) {
            var lich_bu_thay_the = _this.checkLichdaybu(ca_id, thu_id);
            if(lich_bu_thay_the)
              result = lich_bu_thay_the;
            else 
              result = '';
            break;   
        }
      }

      if(demnghi == 0) {

        // for(var item of _this.dangkydaybuList) {
        //   if(item.ca_id == ca_id && item.thu_id == thu_id && item.tentuan == _this.selectedTuanhoc && item.phongmay_id == _this.selectedPhongmay)
        //     dembu++;
        //   if(dembu == 1) {
        //       result = item;
        //       break; 
        //   }
        // }
        var lich_bu_thay_the = _this.checkLichdaybu(ca_id, thu_id);
        if(lich_bu_thay_the)
          result = lich_bu_thay_the;
         else {
          for(var item of _this.lichtrucList) {
            var tuanhoc = JSON.parse(item.tuanhoc);
            if(item.ca_id == ca_id && item.thu_id == thu_id && tuanhoc[_this.selectedTuanhoc] == "x")
              dem++;
            if(dem == 1) {
                result = item;
                break;
            }
          }
        }
        
      }

      return result;
    },
    checkLichdaybu(ca_id, thu_id) {
      var _this = this;
      var dembu = 0;
      var result = '';
      for(var item of _this.dangkydaybuList) {
        if(item.ca_id == ca_id && item.thu_id == thu_id && item.tentuan == _this.selectedTuanhoc && item.phongmay_id == _this.selectedPhongmay)
          dembu++;
        if(dembu == 1) {
            result = item;
            break; 
        }
      }

      return result;
    }
    // editItem (id) {
    //   // this.editedIndex = this.lichtruclist.indexOf(item)
    //   // this.editedItem = Object.assign({}, item)
    //   // this.dialog = true
    //   let path = '/admin/lichtruc/edit/'+id;
    //   let lichtruc_id = id;
    //   this.$router.push({ path: `/admin/lichtruc/edit/${lichtruc_id}` });
    // },

    // deleteItem (item,id) {
    //   Axios.delete(location.origin+'/api/lichtruc/'+id).then((response) => {
    //     const index = this.lichtruclist.indexOf(item)
    //     this.lichtruclist.splice(index, 1)
    //   });
    //   // confirm('Bạn có chắc chắn muốn xóa dữ liệu này?') &&
    // },
  },
  computed: {
    // filteredlichtruc: function(){
    //   if(this.lichtruclist.length) {
    //     return this.lichtruclist;
    //   }
    // },
  }
}
</script>

<style scope>
  .lichtruc-box, .error-text {
    animation: displayLoading 0.5s;
  }
  .slt-hocky:focus {
    border: none;
  }
  .lichtruc-data, .row-thu, .lichtruc-content {
    display: flex;
  }
  .col-ca {
    width: 12.5%;
  }
  .col-thu {
    width: 87.5%;
  }
  .ca-content {
    border: 1px solid white;
    height: 100px;
    background-color: #2a4456;
    color: white;
  }
  .thu-content {
    width: 14.28%;
    border: 1px solid white;
    height: 50px;
    background-color: #19b698;
    color: white;
  }
  .lichtruc-detail {
    text-align: center;
    display: flex;
    justify-content: center;
    align-content: center;
    flex-flow: wrap;
    height: 100%;
  }
  .lichtruc-detail > div {
    align-items: center;
    width: 100%;
  }
  .lichtruc-detail .btn-add {
    align-self: center;
  }
  .name-ktv {
    font-size: 14px;
  }
  @keyframes displayLoading {
    from { opacity: 0 }
    to { opacity: 1 }
  }
  @media screen and (max-width: 1000px) {
    .lichtruc-box {
      overflow-x: scroll;
    }
    .col-ca {
      min-width: 150px;
    }
    .col-thu {
      min-width : 1000px;
    }
  }

</style>

<!-- SELECT chitiet_truc.id, chitiet_truc.ca_id, chitiet_truc.thu_id, kythuatvien.name, chitiet_truc.hocky_id FROM (((chitiet_truc join hocky on chitiet_truc.hocky_id = hocky.id) join thu on chitiet_truc.thu_id = thu.id) JOIN ca on chitiet_truc.ca_id = ca.id) JOIN kythuatvien on chitiet_truc.kythuatvien_id = kythuatvien.id WHERE hocky_id = 17 -->