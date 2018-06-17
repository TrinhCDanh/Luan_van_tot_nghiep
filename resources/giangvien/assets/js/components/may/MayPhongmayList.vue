<template>
	<div id="list-may-phongmay">
		<div v-masonry transition-duration="0.3s" item-selector=".item">
		    <div v-masonry-tile class="item room" v-for="(item, index) in phongmaylist" :key="index">
		    	<div class="room-content">
		    		<h1>{{ item.tenphongmay }}</h1>
		    		<v-btn
		    			class="border-radius"
		    			outline
		    			color="white"
		    			:to="{path: '/kythuatvien/may/phongmay/' + item.id}"
		    		>
		    			Số máy lỗi: {{ item.somayloi == null ? '0' : item.somayloi }}
		    		</v-btn>
		    	</div>
		    </div>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				phongmaylist: [],
				mayloiList: []
			}
		},
		methods: {
			getsoMayLoi(phongmay_id) {
				var soluongmayloi = 0;
				Axios.get(location.origin + '/api/tinhtrangmay-loi/' + phongmay_id).then((response) => {
					var item = { phongmay: phongmay_id, somayloi: response.data };
					this.mayloiList.push(item);
				});
			},

		},
		created: function() {
		    let uri = location.origin + '/api/phongmay';
		    // Axios.get(uri).then((response) => {
			//   this.phongmaylist = response.data;
			//   this.phongmaylist.map((item, index) => {
			// 	this.getsoMayLoi(item.id);
			//   });
			// });
			Axios.get(location.origin + '/api/tinhtrangmay-loi').then((response) => {
			  this.phongmaylist = response.data;
			  console.log(this.phongmaylist);
		    });
		}

	}
</script>

<style>
	.room {
		width: 33.33%;
		padding: 10px;
	}
	.room-content {
		background-color: #00BFA5;
		text-align: center;
		padding: 20px 0;
		overflow: hidden;
		transition: 0.25s;
	}
	.room-content:hover {
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	}
	.border-radius {
		border-radius: 20px;
	}
	@media screen and (max-width: 911px) {
		.room {
			width: 50%;
		}
	}
	@media screen and (max-width: 600px) {
		.room {
			width: 100%;
		}
	}
</style>