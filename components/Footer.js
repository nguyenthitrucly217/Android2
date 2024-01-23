import React from 'react';
import { View, StyleSheet, Image, Text, FlatList, TouchableOpacity} from 'react-native';

const footers = [
  {
    id: 1,
    image: require('../assets/icons/home.png'),
    name: 'Home',

  },
  {
    id:2,
    image: require('../assets/icons/product.png'),
    name: 'Product',
  },

  {
    id:3,    
    image: require('../assets/icons/cart.png'),
    name: 'Cart',


  },
  // {
  //   id: 4,
  //   image: require('../assets/icons/setting.png'),
  //   name: 'Setting',

  // },
  {
    id: 4,
    image: require('../assets/icons/account.png'),
    name: 'Account',

  },

];

const Footer = () => {
  const renderFooterItem = ({ item }) => (

    <TouchableOpacity style={styles.footerItem} >
      <Image source={item.image} style={styles.footerImage} />
      <Text style={styles.footerName}>{item.name}</Text>
    </TouchableOpacity>
  );
  return (
    <View style={styles.footer}>
      <FlatList
        data={footers}
        renderItem={renderFooterItem}
        keyExtractor={(item) => item.id}
        contentContainerStyle={styles.footerList}
        numColumns={5}
      />
    </View>
  );
};

const styles = StyleSheet.create({
  footer: {
    alignItems: 'center',
    justifyContent: 'center',
    backgroundColor:'#FFFFFF',
  },
  footerList: {
    paddingHorizontal: 30,
  },

  footerName: {
    fontSize: 13,
    fontWeight: 'bold',
    marginBottom: 5,
  },
  footerImage: {
    width: 35,
    height: 35,

  },
  footerItem: {
    alignItems: 'center',
    justifyContent: 'center',
    marginRight:15,
    marginLeft:15,
  },

});

export default Footer;