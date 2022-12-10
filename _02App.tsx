import React, {useState} from 'react';
import {View, Text, StyleSheet, FlatList, Alert} from 'react-native';
// import {uuid} from 'uuidv4'
import Header from './components/header'
import ListItem from './components/listitem'
import AddItem from './components/additem'


const App = () => {
  const [items, setItems] = useState([
    {id: 1, text: "Milk"},
    {id: 2, text: "Eggs"},
    {id: 3, text: "Carrots"},
    {id: 4, text: "Butter"},
  ]) 

  const deleteItem = (id) => {
    setItems(prevItems => {
      return prevItems.filter(item => item.id != id)
    })
  }

  const addItem = (text) => {
    console.log(!text);
    if(!text) {
      Alert.alert('Error', 'Please enter an Item')
    } else {
      setItems(prevItems => {
        return [{id: Math.random(), text: text}, ...prevItems]
      })  
    }
  }

  return (
    <View style={styles.container}>
      <Header title="Shopping List"/>
      <AddItem addItem={addItem} />
      <FlatList 
        data={items} 
        renderItem={({item}) =>( 
          <ListItem item={item} deleteItem={deleteItem} />
        )} 
      />
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1, 
  },
});

export default App;