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


export const routes = [
	{ path: '/', component: Layout, name: 'Layout', children: [
		{ path: '/admin/home', component: Home, name: 'Home' },
		
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

		{ path: 'admin/may', component: MayPhongmayList, name: 'MayPhongmayList'},
		{ path: 'admin/may/phongmay/:idphong', component: MayListStatus, name: 'MayListStatus'},
	]}
	
	// { path: '/admin/hocky/edit/:id', component: HockyEdit, name: 'HockyEdit'}
];