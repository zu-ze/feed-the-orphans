import React from 'react';
import { View, Button, Text} from 'react-native'

const SingleProductScreen = ({ navigation, route }) => {
    const {productId} = route.params
    const [product, setProduct] = React.useState([])

    const getSingleProduct = async () => {
        try {
            const response = await fetch("http://localhost/PHP/REST_API/api/product/read_one.php?id="+parseInt(productId));
            const json = await response.json();
            setProduct(json)
        } catch (error) {
            console.error(error);
        } finally {
            // setLoading(false)
        }
    }

    React.useEffect(() => {
        getSingleProduct();

    if (route.params?.post) {
        // Post updated, do something with `route.params.post`
        // For example, send the post to the server
    }
    }, [route.params?.post]);

    return (    
    <View style={{ flex: 1, alignItems: 'center', justifyContent: 'center' }}>
        <Text>name: {product.name}</Text>
        <Text>price: {product.price}</Text>
        <Text>category: {product.category_name}</Text>
        <Text>description: {product.description}</Text>
    </View>)
};

export default SingleProductScreen