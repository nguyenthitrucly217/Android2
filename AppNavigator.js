import { NavigationContainer } from '@react-navigation/native';
import Home from './pages/Home';
import Login from './pages/Login';
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import Register from './pages/Register';
import DetailProduct from './pages/Home/DetailProduct';
import Cart from './pages/Cart';
import SearchProduct from './pages/SearchProduct';
import Pay from './pages/Pay';
import ProCategory from './pages/Category/index';
import User from './pages/User';
import Order from './pages/Order/order';
import Orderdetail from './pages/Order/orderdetail';


const Stack = createNativeStackNavigator();


export default AppNavigator = function(){
  return(
    <NavigationContainer>
      <Stack.Navigator initialRouteName='Login' >
        <Stack.Screen name ='Login' component={Login}/>
        <Stack.Screen name ='Register' component={Register}/>
        <Stack.Screen name ='Home' component={Home}/>
        <Stack.Screen name ='DetailProduct' component={DetailProduct} />
        <Stack.Screen name ='Cart' component={Cart}/>
        <Stack.Screen name ='ProCategory' component={ProCategory}/>
        <Stack.Screen name ='SearchProduct' component={SearchProduct}/>
        <Stack.Screen name ='Pay' component={Pay}/>
        <Stack.Screen name ='User' component={User}/>
        <Stack.Screen name ='Order' component={Order}/>
        <Stack.Screen name ='OrderDetail' component={Orderdetail}/>
      </Stack.Navigator>
    </NavigationContainer>
  )
}