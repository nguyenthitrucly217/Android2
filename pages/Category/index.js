import React, { useEffect, useState } from 'react';
import { View, Text, StyleSheet, Image, TouchableOpacity, FlatList, ScrollView } from 'react-native';
import AsyncStorage from '@react-native-async-storage/async-storage';
import Icon from 'react-native-vector-icons/FontAwesome';
import { useNavigation } from '@react-navigation/native';
import categoryservice from '../../services/CategoryServices';
import { urlImage } from '../../config';
import productservice from '../../services/ProductServices';

const ProCategory = ({ route }) => {
    const { idcategory } = route.params;

    const [products, setProducts] = useState([]);
    const [category, setCategory] = useState([]);
    const [idcat, setidcat] = useState(category[0]);

    const navigation = useNavigation();

    const getAPI = async () => {
        await categoryservice.getAll()
            .then(function (result) {
                setCategory(result.data.categories);

            });

        productservice.getProductByCategoryId(6, idcat.id)
            .then(function (result) {
                setProducts(result.data.products);
            });

    }
    navigation.addListener("focus", () => {
        if (idcategory) {
            setidcat(idcategory);
        }
    })
    useEffect(() => {
        getAPI();
        // console.log("idCat: ",idcat)
    }, [idcat]);

    const refresh_cat = (item) => {
        setidcat(item);
    }


    const renderProductItem = ({ item }) => {
        return (
            <TouchableOpacity
                style={[
                    styles.productItem,
                    //   { backgroundColor: isSelected ? '#e0e0e0' : '#f2f2f2' },
                ]}
                onPress={() => navigation.navigate('DetailProduct', { product: item })}>
                <Image src={urlImage + "product/" + item.image} style={styles.productImage} />
                <Text style={styles.productName}>{item.name}</Text>
                <Text style={styles.productPrice}>{item.price}</Text>
            </TouchableOpacity>
        );
    };


    const renderCategoryItem = ({ item }) => (

        <TouchableOpacity style={styles.categoryItem} onPress={() => refresh_cat(item)}>


            <Image src={urlImage + "category/" + item.image} style={styles.categoryImage} />
            <Text style={styles.categoryName}>{item.name}</Text>
        </TouchableOpacity>
    );


    return (
        <ScrollView contentContainerStyle={styles.container}>

            <View style={styles.header}>
                <Text style={styles.title}>Danh mục { }</Text>
            </View>


            <View style={styles.category}>
                <FlatList
                    data={category}
                    horizontal={true}
                    renderItem={renderCategoryItem}
                    contentContainerStyle={styles.categoryList}
                />
            </View>



            <View style={styles.productList}>
                {products.length > 0 && <FlatList
                    data={products}
                    renderItem={renderProductItem}
                    keyExtractor={(item) => item.id.toString()}
                    numColumns={2}
                />}
            </View>
        </ScrollView>
    );
};

const styles = StyleSheet.create({
    container: {
        flexGrow: 1,
        backgroundColor: '#fff',
    },
    header: {
        paddingVertical: 20,
        paddingHorizontal: 10,
    },
    title: {
        fontSize: 24,
        fontWeight: 'bold',
        marginBottom: 10,
    },
    productList: {
        flexDirection: 'row',
        flexWrap: 'wrap',
        justifyContent: 'space-between',
        paddingHorizontal: 10,
        paddingBottom: 20,
    },
    productItem: {
        width: '48%',
        alignItems: 'center',
        justifyContent: 'center',
        marginVertical: 10,
        marginHorizontal: '1%',
        padding: 20,
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
        // backgroundColor: 'red',
        padding: 10,
        marginTop: 10,
        borderRadius: 5,
        alignItems: 'center',
        justifyContent: 'center',
    },

    category: {
        alignItems: 'center',
        justifyContent: 'center',

    },
    categoryList: {
        paddingHorizontal: 30,
    },

    categoryName: {
        fontSize: 13,
        fontWeight: 'bold',
        marginBottom: 5,
    },
    categoryImage: {
        width: 50,
        height: 50,
        marginBottom: 5,
        marginTop: 10,

    },
    categoryItem: {
        flex: 1,
        alignItems: 'center',
        justifyContent: 'center',
        marginRight: 15,
    },
});

export default ProCategory;