import * as React from 'react';
import {View, StyleSheet, Text, Button, ActivityIndicator, FlatList} from 'react-native'
import ListItem from './listitem'
import {CardComponent} from './card'

const HomeScreen = ({ navigation, route }) => {

  const [isLoading, setLoading] = React.useState(true)
  const [product, setProduct] = React.useState([])

  const singleProduct = (id) => {
    navigation.navigate('SingleProduct', {productId: id})
  }
  
  const getPosts = async () => {
    try {
      const response = await fetch("http://localhost/PHP/REST_API/api/product/read.php");
      const json = await response.json();
      setProduct(json.records)
      // console.log(json.records)
    } catch (error) {
      console.error(error);
    } finally {
      setLoading(false)
    }
  }

  // console.log(products)

  React.useEffect(() => {
    getPosts();

    if (route.params?.post) {
      // Post updated, do something with `route.params.post`
      // For example, send the post to the server
    }
  }, [route.params?.post]);


  return (
      <View style={{ flex: 1, alignItems: 'top', justifyContent: 'center' }}>
        {isLoading ? <ActivityIndicator color="purple" size="large" /> : 
        <FlatList 
          data={product} 
          renderItem={({item}) => <CardComponent item={item} show={singleProduct} /> } 
        /> }
      </View>
    );
};

const styles = StyleSheet.create({
  box: {
      height: 100,
      width: 300,
      margin: 2,
  },
})

export default HomeScreen