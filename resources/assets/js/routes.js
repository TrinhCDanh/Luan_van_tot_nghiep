import Layout from './components/Layout'
import Home from './components/trangchu/Home'

// Quản lý học kỳ
import HockyList from './components/hocky/HockyList'
import HockyAdd from './components/hocky/HockyAdd'
import HockyEdit from './components/hocky/HockyEdit'

// Quản lý ca trực, ca dạy
import CaList from './components/ca/CaList'
import CaAdd from './components/ca/CaAdd'
import CaEdit from './components/ca/CaEdit'

// Quản lý thứ trong tuần
import ThuList from './components/thu/ThuList'
import ThuAdd from './components/thu/ThuAdd'
import ThuEdit from './components/thu/ThuEdit'

// Quản lý phòng máy
import PhongmayList from './components/phongmay/PhongmayList'
import PhongmayAdd from './components/phongmay/PhongmayAdd'
import PhongmayEdit from './components/phongmay/PhongmayEdit'

//import MayListStatus from './components/may/MayListStatus'
import MayList from './components/may/MayList'
import MayPhongmayList from './components/may/MayPhongmayList';
import MayListStatus from './components/may/MayListStatus';
import TinhtrangList from './components/may/TinhtrangList'
import TinhtrangView from './components/may/TinhtrangView'

// Quản lý thông tin ds lớp
import LopList from './components/lop/LopList'
import LopAdd from './components/lop/LopAdd'
import LopEdit from './components/lop/LopEdit'

// Quản lý thông tin môn học
import MonhocList from './components/monhoc/MonhocList'
import MonhocAdd from './components/monhoc/MonhocAdd'
import MonhocEdit from './components/monhoc/MonhocEdit'

// Quản lý kỹ thuật viên
import KythuatvienList from './components/kythuatvien/KythuatvienList'
import KythuatvienAdd from './components/kythuatvien/KythuatvienAdd'
import KythuatvienEdit from './components/kythuatvien/KythuatvienEdit'

// Quản lý giảng viên
import GiangvienList from './components/giangvien/GiangvienList'
import GiangvienAdd from './components/giangvien/GiangvienAdd'
import GiangvienEdit from './components/giangvien/GiangvienEdit'

// Quản lý lịch trực
import LichtrucList from './components/lichtruc/LichtrucList'
import LichtrucAdd from './components/lichtruc/LichtrucAdd'
import LichtrucEdit from './components/lichtruc/LichtrucEdit'

// Quản lý tình trạng 
// import TinhtrangList from './components/tinhtrangmay/TinhtrangList'
// import TinhtrangAdd from './components/tinhtrangmay/TinhtrangAdd'
// import TinhtrangEdit from './components/tinhtrangmay/TinhtrangEdit'
// import TinhtrangView from './components/tinhtrangmay/TinhtrangView'

// Quản lý lịch dạy
import LichdayAdd from './components/lichday/LichdayAdd'
import LichdayList from  './components/lichday/LichdayList'

// Test
import UploadImage from './components/trangchu/UploadImage';


export const routes = [
	{ path: '/', component: Layout, name: 'Layout', children: [
		{ path: '/admin/home', component: Home, name: 'Home' },
		{ path: '/admin/upload-image', component: UploadImage, name: 'UploadImage' },

		{ path: '/admin/hocky', component: HockyList, name: 'HockyList' },
		{ path: '/admin/hocky/add', component: HockyAdd, name: 'HockyAdd'},
		{ path: '/admin/hocky/edit/:id', component: HockyEdit, name: 'HockyEdit'},

		{ path: '/admin/ca', component: CaList, name: 'CaList' },
		{ path: '/admin/ca/add', component: CaAdd, name: 'CaAdd' },
		{ path: '/admin/ca/edit/:id', component: CaEdit, name: 'CaEdit' },

		{ path: '/admin/thu', component: ThuList, name: 'ThuList' },
		{ path: '/admin/thu/add', component: ThuAdd, name: 'ThuAdd' },
		{ path: '/admin/thu/edit/:id', component: ThuEdit, name: 'ThuEdit' },

		{ path: '/admin/phongmay', component: PhongmayList, name: 'PhongmayList' },
		{ path: '/admin/phongmay/add', component: PhongmayAdd, name: 'PhongmayAdd' },
		{ path: '/admin/phongmay/edit/:id', component: PhongmayEdit, name: 'PhongmayEdit' },
		{ path: '/admin/phongmay/may/:idphong', component: MayList, name: 'MayList' },

		{ path: '/admin/may', component: MayPhongmayList, name: 'MayPhongmayList'},
		{ path: '/admin/may/phongmay/:idphong', component: MayListStatus, name: 'MayListStatus'},
		{ path: '/admin/may/tinhtrangmay/:may_slug', component: TinhtrangList, name: 'TinhtrangList' },
		{ path: '/admin/may/tinhtrangmay/:may_slug/view/:id', component: TinhtrangView, name: 'TinhtrangView' },

		{ path: '/admin/lop', component: LopList, name: 'LopList' },
		{ path: '/admin/lop/add', component: LopAdd, name: 'LopAdd'},
		{ path: '/admin/lop/edit/:id', component: LopEdit, name: 'LopEdit'},

		{ path: '/admin/monhoc', component: MonhocList, name: 'MonhocList' },
		{ path: '/admin/monhoc/add', component: MonhocAdd, name: 'MonhocAdd'},
		{ path: '/admin/monhoc/edit/:id', component: MonhocEdit, name: 'MonhocEdit'},

		{ path: '/admin/kythuatvien', component: KythuatvienList, name: 'KythuatvienList' },
		{ path: '/admin/kythuatvien/add', component: KythuatvienAdd, name: 'KythuatvienAdd' },
		{ path: '/admin/kythuatvien/edit/:id', component: KythuatvienEdit, name: 'KythuatvienEdit' },

		{ path: '/admin/giangvien', component: GiangvienList, name: 'GiangvienList' },
		{ path: '/admin/giangvien/add', component: GiangvienAdd, name: 'GiangvienAdd' },
		{ path: '/admin/giangvien/edit/:id', component: GiangvienEdit, name: 'GiangvienEdit' },

		{ path: '/admin/lichtruc', component: LichtrucList, name: 'LichtrucList' },
		{ path: '/admin/lichtruc/add', component: LichtrucAdd, name: 'LichtrucAdd' },
		{ path: '/admin/lichtruc/edit/:id', component: LichtrucEdit, name: 'LichtrucEdit' },

		// { path: '/admin/tinhtrangmay/:may_slug', component: TinhtrangList, name: 'TinhtrangList' },
		// { path: '/admin/tinhtrangmay/:may_slug/add', component: TinhtrangAdd, name: 'TinhtrangAdd' },
		// { path: '/admin/tinhtrangmay/:may_slug/edit/:id', component: TinhtrangEdit, name: 'TinhtrangEdit' },
		// { path: '/admin/tinhtrangmay/:may_slug/view/:id', component: TinhtrangView, name: 'TinhtrangView' },

		{ path: '/admin/lichday', component: LichdayList, name: 'LichdayList' },
		{ path: '/admin/lichday/add', component: LichdayAdd, name: 'LichdayAdd' },
	]}

	// { path: '/admin/hocky/edit/:id', component: HockyEdit, name: 'HockyEdit'}
];