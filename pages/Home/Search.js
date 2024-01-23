import React, { useEffect, useState } from 'react';
import { View, TextInput, StyleSheet, TouchableOpacity } from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import { useNavigation } from '@react-navigation/native';
import SearchableDropDown from 'react-native-searchable-dropdown';
import productservice from '../../services/ProductServices';

const Search = () => {
  const [searchText, setSearchText] = useState([]);

  const navigation = useNavigation();

  const navigateToCart = () => {
    navigation.navigate('Cart');
  };

  const navigateToUser = () => {
    navigation.navigate('User');
  };

  const click = (item) => {
   navigation.navigate("DetailProduct",{product:item})
  }
  const [products, setProducts] = useState([]);
  const getAPI = async () => {
    await productservice.getProductAll(20)
      .then(function (result) {
        setProducts(result.data.products);
      });
  }
 
  useEffect(() => {
    getAPI();
  
  }, []);

  return (
    <View style={styles.container}>
      <View style={styles.inputContainer}>
        <SearchableDropDown
          onTextChange={(item) => console.log(item)}
          onItemSelect={(item) => click(item)}
          defaultIndex={0}
          containerStyle={{
            borderRadius: 5,
            width: "100%",
            elevation: 5,
            position: "absolute",
            zIndex: 20,
            top: -20,
            maxHeight: 300,
            backgroundColor: "#F5F5F5",
          }}
          textInputStyle={{
            borderRadius: 10,
            padding: 6,
            paddingLeft: 10,
            borderWidth: 0,
            backgroundColor: "#ffffff",
          }}
          itemStyle={{
            padding: 10,
            marginTop: 2,
            backgroundColor: "#ffffff",
            borderColor: "#707981",
          }}
          itemTextStyle={{
            color: "#707981",
          }}
          itemsContainerStyle={{
            maxHeight: "100%",
          }}
          items={products}
          placeholder="Tìm kiếm..."
          resetValue={false}
          underlineColorAndroid="transparent"
        />
      </View>
      <TouchableOpacity style={styles.searchButton}
        // onPress={handleSearch}
        onPress={() => {
          navigation.navigate('SearchProduct');
        }}>
        <Ionicons name="search" size={24} color="white" />

      </TouchableOpacity>
      <TouchableOpacity style={styles.PersonButton} onPress={navigateToUser}>
        <Ionicons name="person" size={32} color="maroon" />
      </TouchableOpacity>

      <TouchableOpacity style={styles.cartButton} onPress={navigateToCart}>
        <Ionicons name="cart" size={32} color="maroon" />

      </TouchableOpacity>

    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'space-between',
    // backgroundColor: '#f2f2f2',
    paddingHorizontal: 10,
    borderRadius: 10,
    marginHorizontal: 10,
    marginVertical: 20,
  },
  inputContainer: {
    width: "70%",
    display: "flex",
    justifyContent: "center",
    alignItems: "center",
  },
  input: {
    flex: 1,
    height: 40,
    fontSize: 16,
    backgroundColor: '#f2f2f2',

  },
  searchButton: {
    backgroundColor: '#8A2BE2',
    paddingHorizontal: 12,
    paddingVertical: 8,
    borderRadius: 8,
  },
  cartButton: {
    paddingVertical: 8,
    marginLeft: 10,
  },
  PersonButton: {
    paddingVertical: 8,
    marginLeft: 10,

  }
});

export default Search;