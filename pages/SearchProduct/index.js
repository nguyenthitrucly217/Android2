import React, { useEffect, useState } from 'react';
import { View, Text, StyleSheet, Image, TouchableOpacity, FlatList, TextInput } from 'react-native';
import { Ionicons } from '@expo/vector-icons';

import AsyncStorage from '@react-native-async-storage/async-storage';
import { useNavigation } from '@react-navigation/native';
//     {
//         id: '1',
//         name: 'Product 1',
//         price: '$10',
//         image: require('../../assets/images/bg2.jpg'),
//     },
//     {
//         id: '2',
//         name: 'Product 2',
//         price: '$20',
//         image: require('../../assets/images/bg2.jpg'),
//     },
//     {
//         id: '3',
//         name: 'Product 2',
//         price: '$20',
//         image: require('../../assets/images/bg2.jpg'),
//     },
//     {
//         id: '4',
//         name: 'Product 2',
//         price: '$20',
//         image: require('../../assets/images/bg2.jpg'),
//     },
//     {
//         id: '5',
//         name: 'Product 2',
//         price: '$20',
//         image: require('../../assets/images/bg2.jpg'),
//     },
//     {
//         id: '6',
//         name: 'Product 2',
//         price: '$20',
//         image: require('../../assets/images/bg2.jpg'),
//     },
//     {
//         id: '7',
//         name: 'Product 2',
//         price: '$20',
//         image: require('../../assets/images/bg2.jpg'),
//     },
//     {
//         id: '8',
//         name: 'Product 2',
//         price: '$20',
//         image: require('../../assets/images/bg2.jpg'),
//     },
//     {
//         id: '9',
//         name: 'Product 2',
//         price: '$20',
//         image: require('../../assets/images/bg2.jpg'),
//     },
//     {
//         id: '10',
//         name: 'Product 2',
//         price: '$20',
//         image: require('../../assets/images/bg2.jpg'),
//     },

// ];



const SearchProduct = () => {
    const [pro, setPro] = useState([]);
    const navigation = useNavigation();
    const getAPI = async () => {
        try {
            const response = await fetch('https://dummyjson.com/products');
            const data = await response.json();
            setPro(data.products);
        }
        catch (error) {
            console.log(error);
        }
    }
    useEffect(() => {
        getAPI();
    }, []);


    const renderProductItem = ({ item }) => (

        <TouchableOpacity style={styles.productItem}
            onPress={() => {
                navigation.navigate('DetailProduct', { product: item });
            }}>


            <Image source={{ uri: item.images[0] }} style={styles.productImage} />
            <Text style={styles.productName}>{item.title}</Text>
            <Text style={styles.productPrice}>{item.price}</Text>
        </TouchableOpacity>
    );

    return (
        <View style={styles.home}>
            <View style={styles.container}>
                <TextInput
                    style={styles.input}
                    placeholder=" Search"
                />
                <TouchableOpacity style={styles.searchButton}
                    // onPress={handleSearch}
                    onPress={() => {
                        navigation.navigate('SearchProduct');
                    }}>
                    <Ionicons name="search" size={24} color="white" />
                </TouchableOpacity>
            </View>
            <View>
                <Text style={styles.text}>Sản phẩm tìm kiếm</Text>
            </View>
            <FlatList
                data={pro}
                renderItem={renderProductItem}
                keyExtractor={(item) => item.id}
                contentContainerStyle={styles.productList}
                numColumns={2}
            />
        </View>
    );
};

const styles = StyleSheet.create({
    home: {
        flex: 1,
        backgroundColor:"#ffffff",
        // alignItems: 'center',
        // justifyContent: 'center',
    },
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
        
    text: {
        fontSize: 20,
        marginLeft: 30,
        fontWeight: 'bold',
        color: 'red',
    },
    productList: {
        paddingHorizontal: 10,
    },
    title: {
        fontSize: 15,
        color: 'red'
    },
    productItem: {
        flex: 1,
        alignItems: 'center',
        justifyContent: 'center',
        margin: 10,
        padding: 10,
        backgroundColor: '#f2f2f2',
        borderRadius: 8,
    },
    productImage: {
        width: 150,
        height: 150,
        marginBottom: 10,
        resizeMode: 'cover',
    },
    productName: {
        fontSize: 16,
        fontWeight: 'bold',
        marginBottom: 5,
    },
    productPrice: {
        fontSize: 14,
        color: '#888',
    },
    cartButton: {
        borderRadius: 5,
        alignItems: 'center',
        justifyContent: 'center',
    },

});

export default SearchProduct;