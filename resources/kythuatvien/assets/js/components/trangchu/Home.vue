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
        <p class="display-1">Lịch trực phòng máy</p>
        <v-spacer></v-spacer>
        <select name="carlist" form="carform" class="slt-hocky" v-model="selectedHocky" v-on:change="chooseHocky()">
          <option
            v-for="( hocky, key ) in hockyList"
            :value="hocky.id"
            :key="key"
          >
            {{ hocky.tenhocky }} - {{ hocky.namhoc }}
          </option>
        </select>
      </v-card-title>
      <div class="lichtruc-data">
        <div class="col-ca">
          <div class="ca-content" style="height: 50px">
              <p style="text-align: center; line-height: 50px; font-weight: bold">Today: {{ toDay() }}</p>
          </div>
          <div class="ca-content" v-for="( ca, key ) in caList" :key="key">
            <p style="text-align: center; line-height: 100px; font-weight: bold">{{ ca.tenca }}</p>
          </div>
        </div>
        <div class="col-thu">
          <div class="row-thu">
            <div class="thu-content" v-bind:style="{ backgroundColor: getDatetoDay() == thu.tenthu ? '#2a4456' : '#19b698' }" v-for="( thu, key ) in thuList" :key="key"><p style="text-align: center; line-height: 50px; font-weight: bold">{{ thu.tenthu }}</p></div>
          </div>
          <div class="lichtruc-content">
            <div v-for="( thu, key ) in thuList" style="width: 14.28%;" :key="key">
              <div v-for="( ca, key ) in caList" :key="key">
                <div style="border: 1px solid white; height: 100px; background-color: #eeeeee">
                  <div v-if=" checkLichtruc(ca.id, thu.id) == '' " class="lichtruc-detail">
                    <!-- {{ ca.tenca }} - {{ thu.tenthu }} -->
                      <!-- <v-btn v-on:click="addItem(ca.id, thu.id)">+</v-btn> -->
                      <h3 style="line-height: 100px">N/A</h3>
                  </div>
                  <div v-else  class="lichtruc-detail" v-bind:class="kythuatvien_current_id == checkLichtruc(ca.id, thu.id).kythuatvien_id ? 'highlight' : ''">
                    <div class="name-ktv">{{ checkLichtruc(ca.id, thu.id).name }}</div>
                    <!-- <v-btn v-on:click="deleteItem(ca.id, thu.id)">x</v-btn>
                    <v-btn v-on:click="editItem(checkLichtruc(ca.id, thu.id).id)">e</v-btn> -->
                    <div class="btn-action">
                      <v-btn icon class="mx-0" v-bind:to="{name: 'MayPhongmayList'}" v-if="trucToday == thu.tenthu && kythuatvien_current_id == checkLichtruc(ca.id, thu.id).kythuatvien_id">
                        <v-icon color="teal">visibility</v-icon>
                      </v-btn>
                    </div>

                  </div>

                </div>

              </div>
            </div>


              <!-- <div v-for="( thu, key ) in thuList" style="width: 14.28%;">
                <div v-for="( ca, key ) in caList">
                  <div v-for="( lichtruc, key ) in lichtrucList" >
                    <div
                        v-if=" ca.id == lichtruc.ca_id && thu.id == lichtruc.thu_id "
                        style="background-color: gold;  border: 1px solid white; height: 50px;"
                    >
                      {{ lichtruc.name }}
                      <v-btn v-on:click="addItem(ca.id, thu.id)">E</v-btn>
                    </div>

                    <div v-if=" ca.id != lichtruc.ca_id && thu.id != lichtruc.thu_id " style="background-color: gold;  border: 1px solid white; height: 50px; ">
                      {{ ca.tenca }} - {{ thu.tenthu }}
                      <v-btn v-on:click="addItem(ca.id, thu.id)">+</v-btn>
                    </div>

                  </div>
                </div>
              </div> -->


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
      kythuatvien_current_id: sessionStorage.getItem('kythuatvien_id') || '',
      hockyList: [],
      caList: [],
      thuList: [],
      trucToday: '',
      selectedHocky: 0,
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

    _this.fetchData();

  },
  methods: {
    fetchData() {
      var _this = this;
      _this.isLoading = true;
      
      if(_this.kythuatvien_current_id == '')
      _this.kythuatvien_current_id = sessionStorage.getItem('kythuatvien_id');

      Axios.get(_this.urlCurrent+'/api/ca').then((response) => {
        _this.caList = response.data;
        _this.countLoading++;
      }).catch(function (error) {
        _this.fetchError = 'Xin lỗi, máy chủ gặp vấn đề! Vui lòng load lại trang';
      });

      Axios.get(_this.urlCurrent+'/api/thu').then((response) => {
        _this.thuList = response.data;
        _this.countLoading++;
      }).catch(function (error) {
        _this.fetchError = 'Xin lỗi, máy chủ gặp vấn đề! Vui lòng load lại trang';
      });

      Axios.get(_this.urlCurrent+'/api/hocky').then((response) => {
        _this.hockyList = response.data;
        _this.countLoading++;
        var ngayhientai = Date.now();//new Date('2018-12-12');
        for(var hocky of this.hockyList) {
          var ngaybatdau = new Date(hocky.ngaybatdau).getTime();
          var ngayketthuc = new Date(hocky.ngayketthuc).getTime();
          if(ngaybatdau < ngayhientai && ngayhientai < ngayketthuc) {
            _this.selectedHocky = hocky.id;
            break;
          }
        }

        Axios.get(_this.urlCurrent+'/api/lichtruc-hocky/' + _this.selectedHocky).then((response) => {
         _this.lichtrucList = response.data;
           _this.countLoading++;
           if(_this.countLoading == 4) {
              setTimeout(() => {
                  _this.isLoading = false;
              }, 2000);
           }
        }).catch(function (error) {
          _this.fetchError = 'Xin lỗi, máy chủ gặp vấn đề! Vui lòng load lại trang';
        });

        // Axios.get(_this.urlCurrent+'/api/lichtruc-kythuatvien/' + _this.selectedHocky + '/' + _this.kythuatvien_current_id).then((response) => {
        //    this.lichtrucList = response.data;
        // });

        _this.trucToday = _this.getDatetoDay();
        // console.log('Hello' + _this.trucToday);
        // console.log(_this.kythuatvien_current_id);

      });
    },
    toDay() {
      var today = new Date();
      var dd = today.getDate();
      var mm = today.getMonth()+1; //January is 0!
      var yyyy = today.getFullYear();

      if(dd<10) {
          dd = '0'+dd
      }

      if(mm<10) {
          mm = '0'+mm
      }

      today = mm + '/' + dd + '/' + yyyy;
      return today;
    },
  	chooseHocky() {
    	var _this = this;
    	// Axios.get(_this.urlCurrent+'/api/lichtruc-kythuatvien/' + _this.selectedHocky + '/' + _this.kythuatvien_current_id).then((response) => {
      //   	_this.lichtrucList = response.data;
       // });
      Axios.get(this.urlCurrent+'/api/lichtruc-hocky/' + this.selectedHocky).then((response) => {
        this.lichtrucList = response.data;
      });
    },
    checkLichtruc(ca_id, thu_id) {
      var dem = 0;
      var result = '';
      for(var item of this.lichtrucList) {
        if(item.ca_id == ca_id && item.thu_id == thu_id)
          dem++;
        if(dem == 1) {
          result = item;
          break;
        }
      }
      return result;
    },
    getDatetoDay() {
      // Khai báo đối tượng Date
      var date = new Date();

      // Lấy số thứ tự của ngày hiện tại
      var current_day = date.getDay();

      // Biến lưu tên của thứ
      var day_name = '';

      // Lấy tên thứ của ngày hiện tại
      switch (current_day) {
      case 0:
          day_name = "Chủ nhật";
          break;
      case 1:
          day_name = "Thứ hai";
          break;
      case 2:
          day_name = "Thứ ba";
          break;
      case 3:
          day_name = "Thứ tư";
          break;
      case 4:
          day_name = "Thứ năm";
          break;
      case 5:
          day_name = "Thứ sau";
          break;
      case 6:
          day_name = "Thứ bảy";
      }

      return day_name;

    }
  },
  computed: {

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
  .highlight {
    background-color: gold;
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
<!--  -->