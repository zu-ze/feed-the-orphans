import React, { useState } from 'react';
import { View, Button, Text, TextInput} from 'react-native'
// import Select, { SelectConfig, SelectItem} from '@redmin_delishaj/react-native-select'
import Select from 'react-native-select-dropdown'
// import axios from 'axios'

const CreateProductScreen = ({ navigation, route }) => {
    // const {data} = route.params
    const [name, setName] = React.useState('');
    const [price, setPrice] = React.useState('');
    const [categoryId, setCategoryId] = React.useState('');
    const [description, setDescription] = React.useState('');

    const categories = ['Option 1', 'Option 2', 'Option 3']

    const [selectedItem, setSelectedItem] = useState();

    const createProduct = async () => {

        try {
            const response = await fetch('http://localhost/PHP/REST_API/api/product/create.php', {
                method: 'POST',
                headers: {
                    Accept: 'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    name: name,
                    price: price,
                    category_id: parseInt(categoryId),
                    description: description,
                }),
            });
            const json = await response.json();

            console.log(json);

        }catch(error) {
            console.error(error);
        } 
    }


    return (    
        <View style={{ flex: 1, alignItems: 'center', justifyContent: 'center', backgroundColor: '#e2e2e2' }}>
            <Text style={{fontSize: 23}}>
                Enter Details of New Product
            </Text>
            <TextInput
                multiline
                placeholder="name"
                style={{ height: 50, padding: 10, margin: 5, backgroundColor: 'white' }}
                value={name}
                onChangeText={setName}
            />
            <TextInput
                multiline
                placeholder="price"
                style={{ height: 50, padding: 10, margin: 5, backgroundColor: 'white' }}
                value={price}
                onChangeText={setPrice}
            />
            <Select
                data={categories}
                style={{ height: 50, padding: 10, margin: 5, backgroundColor: 'white' }}
                value={selectedItem}
                onSelect={value => setSelectedItem(value)}
            />
            <TextInput
                multiline
                placeholder="description"
                style={{ height: 200, padding: 10, margin: 5, backgroundColor: 'white' }}
                value={description}
                onChangeText={setDescription}
            />
            <Button
                title="Done"
                onPress={ () => {
                    createProduct()

                    // Pass and merge params back to home screen
                // navigation.navigate({
                //     name: 'Home',
                //     params: { 
                //         name: name,
                //     },
                //     merge: true,
                // });
                }}
            />
        </View>
    )
};

export default CreateProductScreen