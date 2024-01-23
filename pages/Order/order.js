import { useNavigation } from '@react-navigation/native';
import React, { useEffect, useState } from 'react';
import { View, Text, StyleSheet, FlatList, TouchableOpacity, Image } from 'react-native';
import orderservice from "../../services/OrderServices"
import orderdetailservice from "../../services/OrderdetailServices"
import AsyncStorage from '@react-native-async-storage/async-storage';

const Order = () => {
    const navigation = useNavigation();
    const [order, setOrder]=useState([]);
    const [orderdetail, setOrderdetail]=useState([]);
    const [user, setUser]=useState([]);

    getAPI = async () => {
      try {
        const value = await AsyncStorage.getItem('user');
        if (value !== null) {
          await orderservice.getAll(JSON.parse(value).id)
          .then(function (result) {
            setOrder(result.data.orders);
          });
          await orderdetailservice.getAll()
          .then(function (result){
            setOrderdetail(result.data.orderdetails)
          })
        }
      } catch (error) {
        console.error(error);
      }
    };

  

useEffect(() => {
  getAPI();
}, []);


  const renderOrderItem = ({ item }) => {
    return (
      <View style={styles.order}>
        <Text style={styles.orderid}>Mã đơn hàng: {item.id}</Text>
        <Text style={styles.ordertext}>Người nhận: {item.name}</Text>
        <Text style={styles.ordertext}>Số điện thoại: {item.phone}</Text>
        <Text style={styles.ordertext}>Email: {item.email}</Text>
        <Text style={styles.ordertext}>Địa chỉ: {item.address}</Text>
        <Text style={styles.ordertext}>Ghi chú: {item.note}</Text>


        <TouchableOpacity style={styles.noteButton}
        onPress={()=>navigation.navigate("OrderDetail",{_order:item,_orderdetail:orderdetail})}>
          <Text style={styles.chitiet} >Chi tiết đơn hàng</Text>
        </TouchableOpacity>
      </View>
    );
  };

  return (
    <View style={styles.container}>
      <Text style={styles.title}>Tất cả đơn hàng</Text>
      <FlatList
        data={order}
        renderItem={renderOrderItem}
        keyExtractor={(item) => item.id}
      />
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fff',
    paddingHorizontal: 10,
    paddingVertical: 20,
  },
  orderid: {
    fontSize: 21,
    fontWeight: 'bold',
    marginBottom: 10,
  },
  title: {
    fontSize: 24,
    fontWeight: 'bold',
    marginBottom: 10,
  },
  ordertext:{
    fontSize:17,
},

  order: {
    paddingVertical: 10,
    borderBottomWidth: 1,
    borderBottomColor: '#ccc',
  },
  ordername: {
    fontSize: 16,
  },
  productPrice: {
    fontSize: 14,
    color: '#888',
  },
  noteButton: {
    backgroundColor: '#228B22',
    paddingHorizontal: 10,
    paddingVertical: 5,
    borderRadius: 5,
    marginTop:20,
  },
  chitiet: {
    color: '#fff',
    alignItems: "center",
    textAlign: 'center'

  },

  btnPay: {
    width: 380,
    //  width: DEVICE_WIDTH - 40,
    backgroundColor: 'rgba(0,145,234,1)',
    padding: 8,
    borderRadius: 20,
    marginTop: 2,
    alignItems: "center",

  },
  txtPay: {
    color: '#fff',
    width: 150,
    fontSize: 21,
    textAlign: 'center'
  },
});

export default Order;