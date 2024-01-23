import React, { useState } from 'react';
import { TouchableOpacity } from 'react-native';
import { View, Text, StyleSheet, Image } from 'react-native';
import Icon from 'react-native-vector-icons/FontAwesome';
import { Ionicons } from '@expo/vector-icons';

import AsyncStorage from '@react-native-async-storage/async-storage';
import { urlImage } from '../../config';
import { useDispatch,useSelector } from 'react-redux';
import * as actionCreate from "../../states/actionCreate";
import { bindActionCreators } from 'redux';

const DetailProduct = ({ route }) => {
  const { product } = route.params;
  const [quantity, setQuantity] = useState(1);


  dispatch=useDispatch();
  const{ADD_CART}=bindActionCreators(actionCreate,dispatch);
const products =useSelector((state)=>state.product);

  const addToCart = async () => {
    await ADD_CART(product,quantity);
    //  console.log(products);
  };
  return (
    
    <View style={styles.container}>
      <Image src={urlImage + "product/" + product.image} style={styles.productImage} />
      <Text style={styles.productName}>{product.name}</Text>
      <Text style={styles.productPrice}>{product.price} vnd</Text>
      <Text style={styles.productDescription}>Chi tiết: {product.detail}</Text>



      <View style={styles.counterContainer}>
        <View style={styles.counter}>
        <Text style={styles.soluong}>Số lượng:</Text>
          <TouchableOpacity
            style={styles.counterButtonContainer}
            onPress={() => {
              if (quantity > 1) {
                setQuantity(quantity-1);

              }
            }}
          >
            <Text style={styles.counterButtonText}>-</Text>
          </TouchableOpacity>
          <Text style={styles.counterCountText}>{quantity}</Text>
          <TouchableOpacity
            style={styles.counterButtonContainer}
            onPress={() => {
              if (quantity < 10 && quantity < product.quality) {
                setQuantity(quantity+1);
              }
            }}
          >
            <Text style={styles.counterButtonText}>+</Text>
          </TouchableOpacity>
        </View>
      </View>


      <TouchableOpacity style={styles.cartButton} onPress={addToCart}>
        <Icon name="shopping-cart" size={24} color="maroon" />
      </TouchableOpacity>

    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    // alignItems: 'center',
    // justifyContent: 'center',
    padding: 20,
  },
  productImage: {
    width: 370,
    height: 370,
    resizeMode: 'cover',
    marginBottom: 10,
    alignItems: 'center',


  },
  productName: {
    fontSize: 24,
    fontWeight: 'bold',
    marginBottom: 10,
  },
  productPrice: {
    fontSize: 18,
    marginBottom: 10,
    color: "#FF0000"
  },
  productDescription: {
    fontSize: 16,
  },
  cartButton: {
    backgroundColor: 'pink',
    padding: 10,
    marginTop: 10,
    borderRadius: 5,
    alignItems: 'center',
    justifyContent: 'center',
  },
soluong:{
  marginRight:0,
  fontSize:16,
},

  counter: {
    display: "flex",
    flexDirection: "row",
    // justifyContent: "center",
    // alignItems: "center",
    marginBottom: 5,
    marginTop:20,
    
  },
  counterButtonContainer: {
    flexDirection:"row",
    display: "flex",
    width: 30,
    height: 30,
    marginLeft: 10,
    marginRight: 10,
    justifyContent: "center",
    alignItems: "center",
    backgroundColor: "#707981",
    borderRadius: 15,
    elevation: 2,
  },
  counterButtonText: {
    fontSize: 20,
    fontWeight: "bold",
    color: "#ffffff",
  },
  counterCountText: {
    fontSize: 20,
    fontWeight: "bold",
  },

});

export default DetailProduct;