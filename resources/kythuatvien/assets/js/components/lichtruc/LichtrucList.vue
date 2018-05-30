<template id="lichtruc-list">
  <v-card class="lichtruc-box">
    <v-card-title>
      <p class="display-1">Danh sách học kỳ</p>
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

        </div>
        <div class="ca-content" v-for="( ca, key ) in caList">
          <p style="text-align: center; line-height: 100px; font-weight: bold">{{ ca.tenca }}</p>
        </div>
      </div>
      <div class="col-thu">
        <div class="row-thu">
          <div class="thu-content" v-for="( thu, key ) in thuList"><p style="text-align: center; line-height: 50px; font-weight: bold">{{ thu.tenthu }}</p></div>
        </div>
        <div class="lichtruc-content">
          <div v-for="( thu, key ) in thuList" style="width: 14.28%;">
            <div v-for="( ca, key ) in caList">
              <div style="border: 1px solid white; height: 100px; background-color: #eeeeee">
                <div v-if=" checkLichtruc(ca.id, thu.id) == '' " class="lichtruc-detail">
                  <!-- {{ ca.tenca }} - {{ thu.tenthu }} -->
                    <!-- <v-btn v-on:click="addItem(ca.id, thu.id)">+</v-btn> -->
                    <v-btn icon class="mx-0 btn-add" @click="addItem(ca.id, thu.id)">
                      <v-icon color="blue">add</v-icon>
                    </v-btn>
                </div>
                <div v-else  class="lichtruc-detail">
                  <div class="name-ktv">{{ checkLichtruc(ca.id, thu.id).name }}</div>
                  <!-- <v-btn v-on:click="deleteItem(ca.id, thu.id)">x</v-btn>
                  <v-btn v-on:click="editItem(checkLichtruc(ca.id, thu.id).id)">e</v-btn> -->
                  <div class="btn-action">
                    <v-btn icon class="mx-0" @click="editItem(checkLichtruc(ca.id, thu.id).id)">
                      <v-icon color="teal">edit</v-icon>
                    </v-btn>
                    <v-btn icon class="mx-0" @click="deleteItem(ca.id, thu.id)">
                      <v-icon color="pink">delete</v-icon>
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
</template>

<script>
export default {
  data:function(){
    return {
      urlCurrent: location.origin,
      hockyList: [],
      caList: [],
      thuList: [],
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
    // let uri = location.origin+'/api/lichtruc';
    // Axios.get(uri).then((response) => {
    //   this.lichtruclist = response.data;
    //   console.log(this.lichtruclist);
    // });
    var kythuatvien_current_id = sessionStorage.getItem('kythuatvien_id');

    Axios.get(_this.urlCurrent+'/api/ca').then((response) => {
       _this.caList = response.data;
       // console.log(_this.caList);
    });

    Axios.get(_this.urlCurrent+'/api/thu').then((response) => {
       _this.thuList = response.data;
       // console.log(_this.thuList);
    });

    Axios.get(_this.urlCurrent+'/api/hocky').then((response) => {
      _this.hockyList = response.data;
       // console.log(typeof _this.hockyList[0].ngaybatdau);
       // var utc = new Date().toJSON().slice(0,10).replace(/-/g,'-');
       // console.log(utc);
      //var utc = new Date().toJSON().slice(0,10).replace(/-/g,'-');
      // var ngayhientai = utc.getTime();
      // console.log(ngayhientai);
      var ngayhientai = Date.now();//new Date('2018-12-12');
      for(var hocky of this.hockyList) {
        var ngaybatdau = new Date(hocky.ngaybatdau).getTime();
        var ngayketthuc = new Date(hocky.ngayketthuc).getTime();
        if(ngaybatdau < ngayhientai && ngayhientai < ngayketthuc) {
          _this.selectedHocky = hocky.id;
          break;
        }
      }

      Axios.get(_this.urlCurrent+'/api/lichtruc-kythuatvien/' + _this.selectedHocky + '/' + kythuatvien_current_id).then((response) => {
         this.lichtrucList = response.data;
         //console.log(response.data);
      });


    });

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
    chooseHocky() {
      Axios.get(this.urlCurrent+'/api/lichtruc-kythuatvien/' + this.selectedHocky + '/' + kythuatvien_current_id).then((response) => {
        //this.lichtrucList = response.data;
        console.log(response.data);
      });
    },
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