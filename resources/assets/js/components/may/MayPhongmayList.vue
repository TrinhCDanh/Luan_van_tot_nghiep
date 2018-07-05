<template>
	<div id="list-may-phongmay">
		<div v-masonry transition-duration="0.3s" item-selector=".item">
		    <div v-masonry-tile class="item room" v-for="(item, index) in phongmaylist">
		    	<div class="room-content">
		    		<h1>{{ item.tenphongmay }}</h1>
		    		<v-btn class="border-radius" :to="{path: '/admin/may/phongmay/' + item.id,params: { tenphongmay: item.tenphongmay }}">Xem danh sách máy</v-btn>
		    	</div>
		    </div>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				phongmaylist: []
			}
		},
		methods: {

		},
		created: function() {
		    let uri = location.origin + '/api/phongmay';
		    Axios.get(uri).then((response) => {
		      this.phongmaylist = response.data;
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
		background-color: #CDDC39 ;
		text-align: center;
		padding: 20px 0;
		overflow: hidden;
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