import React, { useEffect, useState } from 'react';
import { View, Text, StyleSheet, FlatList, TouchableOpacity, Image } from 'react-native';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { useNavigation } from '@react-navigation/native';
import { useDispatch, useSelector } from 'react-redux';
import { urlImage } from '../../config';
import { bindActionCreators } from 'redux';
import * as actionCreate from "../../states/actionCreate";

const Cart = () => {
  const products = useSelector((state) => state.product);
  const [cartItems, setCartItems] = useState([]);
  const navigation = useNavigation();
  const [refresh, setRefresh] = useState(false);

  dispatch = useDispatch();
  const {TANGSL,GIAMSL,DELETE} = bindActionCreators(actionCreate, dispatch);

  useEffect(() => {
    setCartItems(products);
    console.log(products);
  }, [products, refresh]);



  const tangsl = async (item) => {
    if(item.quantity <10)
    {await TANGSL({id:item._id,type:"tang"});
    };
    setRefresh(!refresh);
     console.log("tang", products);
  };

  const giamsl = async (item) => {
    if(item.quantity >1){
      await GIAMSL({id:item._id,type:"giam"});
    }
    setRefresh(!refresh);
     console.log("giam:",products);
  };

  const deletepro = async(item)=>{
    await DELETE(item);
    setRefresh(!refresh);

  };


  const renderCartItem = ({ item }) => {
    return (
      <View style={styles.cartItem}>
        <Image src={urlImage + "product/" + item.image} style={styles.productImage} />
        <Text style={styles.productName}>{item.name}</Text>
        <View style={styles.congtru}>
          <TouchableOpacity onPress={() => giamsl(item)}>
            <Text style={{ fontSize: 16 }}>-</Text>
          </TouchableOpacity>
        </View >
        <Text style={styles.quantity}>{item.quantity}</Text>
        <View style={styles.congtru}>
          <TouchableOpacity onPress={() => tangsl(item)}>
            <Text style={{ fontSize: 16 }}>+</Text>
          </TouchableOpacity>
        </View>


        <Text style={styles.productPrice}>{item.price}</Text>
        <TouchableOpacity onPress={() => deletepro(item)} style={styles.removeButton}>
          <Text style={styles.removeButtonText}>Xóa</Text>
        </TouchableOpacity>
      </View>
    );
  };

  return (
    <View style={styles.container}>
      <Text style={styles.title}>Giỏ hàng</Text>
      <FlatList
        data={cartItems}
        renderItem={renderCartItem}
        keyExtractor={(item) => item.id}
      />
      {/* {console.log(cartItems)} */}
      <TouchableOpacity
        style={styles.btnThanhtoan}
        onPress={() => {
          navigation.navigate('Pay');
        }}>
        <Text style={styles.textThanhtoan}>Thanh Toán</Text>
      </TouchableOpacity>

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
  title: {
    fontSize: 24,
    fontWeight: 'bold',
    marginBottom: 10,
  },
  quantity: {
    color: 'black',
  },
  cartItem: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    paddingVertical: 10,
    borderBottomWidth: 1,
    borderBottomColor: '#ccc',
  },
  productImage: {
    width: 80,
    height: 80,
    resizeMode: 'cover',
    borderRadius: 5,
  },
  productName: {
    fontSize: 16,
    fontWeight: 'bold',
  },
  productPrice: {
    fontSize: 14,
    color: '#888',
  },
  removeButton: {
    backgroundColor: '#ff0000',
    paddingHorizontal: 10,
    paddingVertical: 5,
    borderRadius: 5,
  },
  removeButtonText: {
    color: '#fff',
  },
  btnThanhtoan: {
    width: 390,
    //  width: DEVICE_WIDTH - 40,
    backgroundColor: 'rgba(0,145,234,1)',
    padding: 8,
    borderRadius: 20,
    marginTop: 2,
    alignItems: "center",
    textAlign:"center",

  },
  textThanhtoan: {
    color: '#fff',
    width: 150,
    fontSize: 21,
    textAlign: 'center'
  },
  congtru:{
    paddingHorizontal: 7,
    paddingVertical: 5,
    backgroundColor: '#ffffff',
    borderRadius: 20,

  }
});

export default Cart;