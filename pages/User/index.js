import AsyncStorage from '@react-native-async-storage/async-storage';
import { useNavigation } from '@react-navigation/native';
import React, { useEffect, useState } from 'react';
import { View, StyleSheet, Image, Button, TouchableOpacity, Text, FlatList, ScrollView } from 'react-native';


const User = () => {
  const navigation = useNavigation();
  const [user, setUser] = useState({});
  
  _retrieveData = async () => {
    try {
      const value = await AsyncStorage.getItem('user');
      if (value !== null) {
        setUser(JSON.parse(value));
         console.log(value);
      }
    } catch (error) {
      console.error(error);
    }
  };
  useEffect(() => {
    _retrieveData();
 
  },[]);


  return (
    <View style={styles.user}>
      <View style={styles.user}>
        {/* <Image source={item.image} style={styles.userImage} /> */}
        <Text style={styles.username}>Họ và tên:  {user.name}</Text>
        <Text style={styles.usertext}>Email:  {user.email}</Text>
        <Text style={styles.usertext}>Số điện thoại:  {user.phone}</Text>
        {/* <Text style={styles.usertext}>Địa chỉ:{item.}</Text> */}

        <Text style={styles.order} onPress={() => { navigation.navigate("Order");}}>Đơn hàng của bạn</Text>
      </View>
      <TouchableOpacity style={styles.button} onPress={()=>{AsyncStorage.removeItem("user"); navigation.navigate("Login")}}>
        <Text style={styles.buttonText}>Đăng xuất</Text>
      </TouchableOpacity>

    </View>

  );
}
const styles = StyleSheet.create({
  user: {
    flex: 1,
    // alignItems: 'center',
    // justifyContent: 'center',
    padding: 20,
  },
  userImage: {
    width: 120,
    height: 120,
    resizeMode: 'cover',
    marginBottom: 10,
    alignItems: 'center',


  },
  username: {
    fontSize: 24,
    fontWeight: 'bold',
    marginBottom: 10,
    marginBottom: 50,
  },

  usertext: {
    fontSize: 18,
    padding: 8,
  },
  order: {
    fontSize: 20,
    color: "red",
    padding: 8,
  },
  button: {
    backgroundColor: '#ee4d2d',
    paddingVertical: 12,
    borderRadius: 5,
  },
  buttonText: {
    color: 'white',
    fontSize: 16,
    fontWeight: 'bold',
    textAlign: 'center',
  },

});

export default User;