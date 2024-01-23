import React, { useEffect, useState } from 'react';
import { View, Text, StyleSheet, Image, TouchableOpacity, FlatList } from 'react-native';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { useNavigation } from '@react-navigation/native';
import productservice from '../../services/ProductServices';
import { urlImage } from "../../config";




const Product = () => {
    const [products, setProducts] = useState([]);
    const navigation = useNavigation();
    const getAPI = async () => {


        await productservice.getProductAll(20)
            .then(function (result) {
                setProducts(result.data.products);
            });
    }
    //     try {
    //         const response = await fetch('http://localhost/TrucLy/NguyenThiTrucLy_Laravel/public/api/product/index');
    //         const data = await response.json();
    //         setPro(data.products);
    //     }
    //     catch (error) {
    //         console.log(error);
    //     }
    // }
    useEffect(() => {
        getAPI();
    }, []);


    const renderProductItem = ({ item }) => (

        <TouchableOpacity style={styles.productItem}
            onPress={() => {
                navigation.navigate('DetailProduct', { product: item });
            }}>


            <Image src={urlImage+"product/"+item.image} style={styles.productImage} />
            <Text style={styles.productName}>{item.name}</Text>
            <Text style={styles.productPrice}>{item.price}</Text>
        </TouchableOpacity>
    );

    return (
        <View style={styles.home}>
            <View>
                <Text style={styles.text}>Sản phẩm</Text>
            </View>
            <FlatList
                data={products}
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
        // alignItems: 'center',
        // justifyContent: 'center',
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
});

export default Product;