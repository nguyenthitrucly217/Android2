import React, { useEffect, useState } from 'react';
import { View, Text, StyleSheet, FlatList, TouchableOpacity, Image } from 'react-native';
import { urlImage } from '../../config';

const Orderdetail = ({ route }) => {
    const [order, setOrder] = useState([route.params._order]);
    const [orderdetail, setOrderdetail] = useState([route.params._orderdetail]);
    const [orderdetailByIdOrder, setOrderdetailById] = useState([]);
    const Reload = async () => {
        const a = await orderdetail.filter((item) => item.order_id === order.id);
        setOrderdetailById(a);
    }


    useEffect(() => {
        Reload();
        // console.log("rrr",orderdetailByIdOrder);
    }, [])

    const renderOrderItem = ({ item }) => {
        return (
            <View style={styles.order}>
                <View style={styles.prorder}>
                    <Image src={urlImage+"product/"+item.product_image} style={styles.orderImage} />
                    <View>
                        <Text style={styles.ordertext}>Mã sản phẩm: {item.product_id}</Text>
                        <Text style={styles.ordertext}>Tên sản phẩm: {item.product_name}</Text>
                        <Text style={styles.ordertext}>Số lượng: {item.quality}</Text>
                        <Text style={styles.ordertext}>Giá: {item.price} vnđ</Text>

                    </View>
                </View>
                <Text style={styles.ordertextPrice}>Tổng: {item.amount} vnd</Text>



            </View>
        );
    };

    return (
        <View style={styles.container}>
            <Text style={styles.title}>Chi tiết đơn hàng</Text>
            <FlatList
                data={orderdetailByIdOrder[0]}
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
        fontSize: 20,
        fontWeight: 'bold',
        marginBottom: 10,
    },
    ordertext: {
        fontSize: 17,
    },
    ordertextPrice: {
        fontSize: 20,
        color: "#00CED1",
    },
    title: {
        fontSize: 24,
        fontWeight: 'bold',
        marginBottom: 10,
    },

    order: {
        paddingVertical: 10,
        borderBottomWidth: 1,
        borderBottomColor: '#ccc',
    },

    prorder: {
        marginTop: 20,
        flexDirection: "row"
    },
    ordername: {
        fontSize: 16,
    },
    orderImage: {
        width: 100,
        height: 100,
        marginRight: 20,
        marginBottom: 20,
    },
    noteButton: {
        backgroundColor: '#228B22',
        paddingHorizontal: 10,
        paddingVertical: 5,
        borderRadius: 5,
        marginTop: 20,
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
});

export default Orderdetail;