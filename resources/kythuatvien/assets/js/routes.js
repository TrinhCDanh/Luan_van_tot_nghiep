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
//import KythuatvienEdit from './components/kythuatvien/KythuatvienEdit'

// Quản lý lịch trực
import LichtrucList from './components/lichtruc/LichtrucList'
import LichtrucAdd from './components/lichtruc/LichtrucAdd'
import LichtrucEdit from './components/lichtruc/LichtrucEdit'


export const routes = [
	{ path: '/', component: Layout, name: 'Layout', children: [
		{ path: '/kythuatvien/home', component: Home, name: 'Home' },

		{ path: '/kythuatvien/hocky', component: HockyList, name: 'HockyList' },
		{ path: '/kythuatvien/hocky/add', component: HockyAdd, name: 'HockyAdd'},
		{ path: '/kythuatvien/hocky/edit/:id', component: HockyEdit, name: 'HockyEdit'},

		{ path: '/kythuatvien/ca', component: CaList, name: 'CaList' },
		{ path: '/kythuatvien/ca/add', component: CaAdd, name: 'CaAdd' },
		{ path: '/kythuatvien/ca/edit/:id', component: CaEdit, name: 'CaEdit' },

		{ path: '/kythuatvien/thu', component: ThuList, name: 'ThuList' },
		{ path: '/kythuatvien/thu/add', component: ThuAdd, name: 'ThuAdd' },
		{ path: '/kythuatvien/thu/edit/:id', component: ThuEdit, name: 'ThuEdit' },

		{ path: '/kythuatvien/phongmay', component: PhongmayList, name: 'PhongmayList' },
		{ path: '/kythuatvien/phongmay/add', component: PhongmayAdd, name: 'PhongmayAdd' },
		{ path: '/kythuatvien/phongmay/edit/:id', component: PhongmayEdit, name: 'PhongmayEdit' },
		{ path: '/kythuatvien/phongmay/may/:idphong', component: MayList, name: 'MayList' },

		{ path: 'kythuatvien/may', component: MayPhongmayList, name: 'MayPhongmayList'},
		{ path: 'kythuatvien/may/phongmay/:idphong', component: MayListStatus, name: 'MayListStatus'},

		{ path: '/kythuatvien/lop', component: LopList, name: 'LopList' },
		{ path: '/kythuatvien/lop/add', component: LopAdd, name: 'LopAdd'},
		{ path: '/kythuatvien/lop/edit/:id', component: LopEdit, name: 'LopEdit'},

		{ path: '/kythuatvien/monhoc', component: MonhocList, name: 'MonhocList' },
		{ path: '/kythuatvien/monhoc/add', component: MonhocAdd, name: 'MonhocAdd'},
		{ path: '/kythuatvien/monhoc/edit/:id', component: MonhocEdit, name: 'MonhocEdit'},

		{ path: 'kythuatvien/kythuatvien', component: KythuatvienList, name: 'KythuatvienList' },
		{ path: 'kythuatvien/kythuatvien/add', component: KythuatvienAdd, name: 'KythuatvienAdd' },
		// { path: 'amdin/kythuatvien/edit/:id', component: KythuatvienEdit, name: 'KythuatvienEdit' },

		{ path: 'kythuatvien/lichtruc', component: LichtrucList, name: 'LichtrucList' },
		{ path: 'kythuatvien/lichtruc/add', component: LichtrucAdd, name: 'LichtrucAdd' },
		{ path: 'kythuatvien/lichtruc/edit/:id', component: LichtrucEdit, name: 'LichtrucEdit' },
	]}

	// { path: '/kythuatvien/hocky/edit/:id', component: HockyEdit, name: 'HockyEdit'}
];